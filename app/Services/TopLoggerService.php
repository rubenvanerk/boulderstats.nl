<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use RubenVanErk\TopLoggerPhpSdk\Data\Ascend;
use RubenVanErk\TopLoggerPhpSdk\Data\Gym;
use RubenVanErk\TopLoggerPhpSdk\Data\User;
use RubenVanErk\TopLoggerPhpSdk\Data\UserStats;
use RubenVanErk\TopLoggerPhpSdk\Requests\Ascend\ListAscends;
use RubenVanErk\TopLoggerPhpSdk\Requests\Gym\ListGymsRequest;
use RubenVanErk\TopLoggerPhpSdk\Requests\Gym\ListRankedUsersRequest;
use RubenVanErk\TopLoggerPhpSdk\Requests\User\GetUserStatsRequest;

class TopLoggerService
{
    /**
     * @return Collection<Gym>
     */
    public function getGyms(): Collection
    {
        return Cache::rememberForever(
            'gym_resources',
            fn () => collect((new ListGymsRequest())->send()->dto())
        );
    }

    /**
     * @param  int  $gymId
     * @return Collection<User>
     */
    public function getRankedUsersByGym(int $gymId): Collection
    {
        $request = new ListRankedUsersRequest($gymId);
        $request->setQuery(['climbs_type' => 'boulders', 'ranking_type' => 'grade']);

        return collect($request->send()->dto());
    }

    public function getUserStats(User $user): UserStats
    {
        return Cache::rememberForever(
            'stats'.$user->id,
            function () use ($user) {
                $request = new GetUserStatsRequest($user->id);

                return $request->send()->dto();
            }
        );
    }

    public function getAscends(User $user): Collection
    {
        $ascends = Cache::rememberForever(
            'ascends'.$user->id,
            function () use ($user) {
                $request = new ListAscends($user->uid);

                $request->addFilter('used', true);
                $request->addQuery('serialize_checks', true);

                return $request->send()->dto();
            }
        );

        $user->stats->sessionCount = collect($ascends)
            ->filter(fn (Ascend $ascend) => ! empty($ascend->dateLogged))
            ->unique(fn ($ascend) => (new Carbon($ascend->dateLogged))->format('Y-m-d'))
            ->count();

        return collect($ascends);
    }
}
