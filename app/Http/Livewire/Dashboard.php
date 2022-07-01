<?php

namespace App\Http\Livewire;

use App\DataTransferObjects\GymFactory;
use App\DataTransferObjects\User;
use App\DataTransferObjects\UserFactory;
use App\Services\TopLoggerService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Dashboard extends Component
{
    public ?Collection $users;

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
        $this->users = collect(Session::get('users'));
        $this->addUser = false;
    }

    public function hydrate(): void
    {
        if (isset($this->users)) {
            $this->users = $this->users->map(fn ($user) => UserFactory::make($user));
        }
    }
}
