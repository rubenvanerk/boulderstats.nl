<?php

namespace App\Services;

use App\DataTransferObjects\Gym;
use App\DataTransferObjects\User;
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
        return Cache::rememberForever(
            'gym_resources',
            function () {
                $gyms = $this->topLogger->gyms()->filter(['live' => true])->include(['gym_resources'])->all();

                return collect($gyms)
                    ->map(fn ($object) => new Gym((array) $object))
                    ->values();
            }
        );
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
}
