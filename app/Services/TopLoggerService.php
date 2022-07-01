<?php

namespace App\Services;

use App\DataTransferObjects\Ascend;
use App\DataTransferObjects\Gym;
use App\DataTransferObjects\User;
use App\DataTransferObjects\UserStats;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use RubenVanErk\TopLoggerPhpSdk\TopLogger;

class TopLoggerService
{
    private TopLogger $topLogger;

    public function __construct()
    {
        $this->topLogger = new TopLogger();
    }

    /**
     * @return Collection<Gym>
     */
    public function getGyms(): Collection
    {
        $gyms = Cache::rememberForever(
            'gym_resources',
            fn () => $this->topLogger->gyms()->filter(['live' => true])->include(['gym_resources'])->all()
        );

        return collect($gyms)
            ->map(fn ($object) => new Gym((array) $object))
            ->values();
    }

    /**
     * @param  int  $gymId
     * @return Collection<User>
     */
    public function getRankedUsersByGym(int $gymId): Collection
    {
        $rankedAthletes = $this->topLogger->gyms()
            ->rankedAthletes($gymId)
            ->param([
                'climbs_type' => 'boulders',
                'ranking_type' => 'grade',
            ])
            ->get();

        return collect($rankedAthletes)
            ->map(fn ($object) => new User((array) $object))
            ->values();
    }

    public function getUserStats(User $user): UserStats
    {
        $userStats = Cache::rememberForever(
            'stats'.$user->id,
            fn () => $this->topLogger->users()->stats($user->id)
        );

        return new UserStats((array) $userStats);
    }

    public function getAscends(User $user): Collection
    {
        $ascends = Cache::rememberForever(
            'ascends'.$user->id,
            fn () => $this->topLogger->ascends()
                ->filter(['used' => true])
                ->filter(['user' => ['uid' => $user->uid]])
                ->param(['serialize_checks' => true])
                ->include(['climb'])
                ->get()
        );

        $user->stats->sessionCount = collect($ascends)
            ->unique(fn ($ascend) => (new Carbon($ascend->date_logged))->format('Y-m-d'))
            ->count();

        return collect($ascends)
            ->map(fn ($object) => new Ascend((array) $object))
            ->values();
    }
}
