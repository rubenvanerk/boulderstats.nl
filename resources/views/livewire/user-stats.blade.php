<div class="contents" wire:init="loadStats">

    <span class="text-2xl font-bold text-gray-800 sm:text-3xl sm:truncate">{{ $user->firstName . ' ' . $user->lastName }}</span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->stats)
            {{ $gradeFont60d }} <sup class="text-gray-400 text-xs font-semibold">+{{ $gradeProgression60d }}%</sup>
        @else
            <x-placeholder/>
        @endif
    </span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->ascends)
            {{ $user?->ascends?->count() }}
        @else
            <x-placeholder/>
        @endif
    </span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->stats)
            {{ $user->stats->sessionCount ?: '?' }}
        @else
            <x-placeholder/>
        @endif
    </span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->stats)
            @if($user?->stats?->sessionCount)
                {{ round($user?->ascends?->count() / $user?->stats?->sessionCount, 1) ?? '?' }}
            @else
                ?
            @endif
        @else
            <x-placeholder/>
        @endif
    </span>
</div>
