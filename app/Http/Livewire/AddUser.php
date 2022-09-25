<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use RubenVanErk\TopLoggerPhpSdk\Data\Gym;
use RubenVanErk\TopLoggerPhpSdk\Data\User;
use RubenVanErk\TopLoggerPhpSdk\Requests\Gym\ListGymsRequest;
use RubenVanErk\TopLoggerPhpSdk\Requests\Gym\ListRankedUsersRequest;

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

    public function render()
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

    public function submit(): void
    {
        $users = Session::get('userIds', []);
        if (!in_array($this->userId, $users, true)) {
            $users[] = $this->userId;
        }
        Session::put('userIds', $users);

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
