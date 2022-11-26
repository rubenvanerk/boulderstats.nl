<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use RubenVanErk\TopLoggerPhpSdk\Classes\GradeConverter;
use RubenVanErk\TopLoggerPhpSdk\Requests\User\GetUserRequest;

class UserStats extends Component
{
    public bool $readyToLoad = false;

    public int $userId;

    public string $gradeFont60d = '';
    public int $gradeProgression60d = 0;

    public function render(TopLoggerService $topLoggerService): View
    {
        $user = (new GetUserRequest($this->userId))->send()->dto();

        if ($this->readyToLoad) {
            $user->stats = $topLoggerService->getUserStats($user);
            $user->ascends = $topLoggerService->getAscends($user);

            $gradeConverter = GradeConverter::fromGrade($user->stats->grade);
            $this->gradeFont60d = $gradeConverter->toFont();
            $this->gradeProgression60d = $gradeConverter->getProgress();
        }

        return view('livewire.user-stats', compact('user'));
    }

    public function loadStats(): void
    {
        $this->readyToLoad = true;
    }

    public function remove()
    {
        $users = Session::get('userIds', []);
        $users = collect($users)->filter(fn($userId) => $userId != $this->userId)->toArray();
        Session::put('userIds', $users);

        $this->emit('userRemoved', $this->userId);
    }
}
