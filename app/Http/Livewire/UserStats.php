<?php

namespace App\Http\Livewire;

use App\Services\TopLoggerService;
use App\Services\UserHandler;
use Illuminate\Contracts\View\View;
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
        $lastSession = null;

        if ($this->readyToLoad) {
            $user->stats = $topLoggerService->getUserStats($user);
            $user->ascends = $topLoggerService->getAscends($user);

//            $lastLogAt = new Carbon($user->ascends->max('dateLogged'));
//            $lastSession = $user->ascends->filter(fn($ascend) => (new Carbon($ascend->dateLogged))->isSameDay($lastLogAt));

            $gradeConverter = GradeConverter::fromGrade($user->stats->grade);
            $this->gradeFont60d = $gradeConverter->toFont();
            $this->gradeProgression60d = $gradeConverter->getProgress();
        }

        return view('livewire.user-stats', compact('user', 'lastSession'));
    }

    public function loadStats(): void
    {
        $this->readyToLoad = true;
    }

    public function remove()
    {
        app(UserHandler::class)->removeUser($this->userId);

        $this->emit('userRemoved', $this->userId);
    }
}
