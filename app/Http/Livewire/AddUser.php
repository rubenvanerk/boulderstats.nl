<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use App\Services\UserHandler;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use RubenVanErk\TopLoggerPhpSdk\Data\Gym;
use RubenVanErk\TopLoggerPhpSdk\Data\User;

class AddUser extends Component
{
    public Collection $gyms;

    public $gymId;

    public Collection $users;

    public $userId;

    protected TopLoggerService $topLoggerService;

    public function boot(): void
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function mount(): void
    {
        $this->gyms = $this->topLoggerService
            ->getGyms()
            ->sortBy('name')
            ->values();
    }

    public function render(): View
    {
        return view('livewire.add-user');
    }

    public function updatedGymId(): void
    {
        $this->users = $this->topLoggerService
            ->getRankedUsersByGym($this->gymId)
            ->sortBy('fullName')
            ->values();
    }

    public function submit(UserHandler $userHandler): void
    {
        $userHandler->addUser($this->userId);
        $this->emit('userAdded');
    }

    public function hydrate(): void
    {
        $this->gyms = $this->gyms->map(function (array $gym): Gym {
            $gym['id_name'] = $gym['idName'];
            return new Gym($gym);
        });

        if (isset($this->users)) {
            $this->users = $this->users->map(function (array $user): User {
                $user['full_name'] = $user['fullName'];
                return new User($user);
            });
        }
    }
}
