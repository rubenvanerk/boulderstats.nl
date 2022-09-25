<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
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
    ];

    public function boot(): void
    {
        $this->topLoggerService = new TopLoggerService();
    }

    public function mount(): void
    {
        $this->updateUsers();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function updateUsers(): void
    {
        $this->userIds = Session::get('userIds', []);
        $this->addUser = false;
    }
}
