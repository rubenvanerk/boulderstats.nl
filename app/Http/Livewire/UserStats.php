<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use Livewire\Component;
use RubenVanErk\TopLoggerPhpSdk\Requests\User\GetUserRequest;

class UserStats extends Component
{
    public bool $readyToLoad = false;

    public int $userId;

    private TopLoggerService $topLoggerService;

    public function boot()
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function render()
    {
        $user = (new GetUserRequest($this->userId))->send()->dto();

        if ($this->readyToLoad) {
            $user->stats = $this->topLoggerService->getUserStats($user);
            $user->ascends = $this->topLoggerService->getAscends($user);
        }

        return view('livewire.user-stats', compact('user'));
    }

    public function loadStats(): void
    {
        $this->readyToLoad = true;
    }
}
