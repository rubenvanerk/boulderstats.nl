<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Onboarding extends Component
{
    public Collection $gyms;
    public $gymId;
    public Collection $users;
    public $userId;

    protected TopLoggerService $topLoggerService;

    public function boot()
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function mount()
    {
        $this->gyms = $this->topLoggerService
            ->getGyms()
            ->sortBy('name')
            ->values();
    }

    public function render()
    {
        return view('livewire.onboarding');
    }

    public function updatedGymId(): void
    {
        $this->users = $this->topLoggerService
            ->getRankedUsersByGym($this->gymId)
            ->sortBy('full_name')
            ->values();
    }

    public function submit(): void
    {
        Session::put('user_ids', [$this->userId]);

        $this->emit('onboarding.complete');
    }
}
