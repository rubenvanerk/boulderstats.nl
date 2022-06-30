<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use RubenVanErk\TopLoggerPhpSdk\TopLogger;

class Stats extends Component
{
    public $userIds;

    protected TopLogger $topLogger;

    public $ascends;

    protected $listeners = [
        'onboarding.complete' => 'updateUsers',
    ];

    public function boot()
    {
        $this->topLogger = new TopLogger();
    }

    public function mount()
    {
        $this->updateUsers();
    }

    public function render()
    {
        return view('livewire.stats');
    }

    public function updateUsers()
    {
        $this->userIds = Session::get('user_ids');
    }
}
