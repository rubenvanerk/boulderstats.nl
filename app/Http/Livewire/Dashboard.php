<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Dashboard extends Component
{
    public ?array $userIds;

    public $stats;

    protected TopLoggerService $topLoggerService;

    public bool $addUser = false;

    protected $listeners = [
        'userAdded' => 'updateUsers',
        'userRemoved' => 'updateUsers',
    ];

    public function boot(): void
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function mount(): void
    {
        $this->updateUsers();
    }

    public function render(): View
    {
        return view('livewire.dashboard');
    }

    public function updateUsers(): void
    {
        $this->userIds = Session::get('userIds', []);
        $this->addUser = false;
    }

    public function refresh()
    {
        foreach ($this->userIds as $userId) {
            Cache::forget('ascends'.$userId);
            Cache::forget('stats'.$userId);
        }
    }
}
