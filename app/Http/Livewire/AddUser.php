<?php

namespace App\Http\Livewire;

use App\DataTransferObjects\GymFactory;
use App\DataTransferObjects\UserFactory;
use App\Services\TopLoggerService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

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
        $user = $this->users->firstWhere('id', $this->userId);

        $users = Session::get('users', []);
        $users[$user->id] = $user;
        Session::put('users', $users);

        $this->emit('userAdded');
    }

    public function hydrate(): void
    {
        $this->gyms = $this->gyms->map(fn ($gym) => GymFactory::make($gym));
        if (isset($this->users)) {
            $this->users = $this->users->map(fn ($user) => UserFactory::make($user));
        }
    }
}
