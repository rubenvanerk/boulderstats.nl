<?php

namespace App\Http\Livewire;

use App\DataTransferObjects\User;
use App\Services\TopLoggerService;
use Livewire\Component;

class UserStats extends Component
{
    public bool $readyToLoad = false;

    public User $user;

    private TopLoggerService $topLoggerService;

    public function boot()
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->user->stats = $this->topLoggerService->getUserStats($this->user);
            $this->user->ascends = $this->topLoggerService->getAscends($this->user);
        }

        return view('livewire.user-stats');
    }

    public function loadStats(): void
    {
        $this->readyToLoad = true;
    }
}
