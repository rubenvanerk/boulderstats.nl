<div class="contents" wire:init="loadStats">

    <span class="text-2xl font-bold text-gray-800 sm:text-3xl sm:truncate">{{ $user->fullName }}</span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->stats)
            {{ $user?->stats?->grade }}
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
            {{ $user?->stats?->sessionCount ?: '?' }}
        @else
            <x-placeholder/>
        @endif
    </span>
    <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">
        @if($user->stats)
            {{ round($user?->ascends?->count() / $user?->stats?->sessionCount, 1) ?? '?' }}
        @else
            <x-placeholder/>
        @endif
    </span>
</div>
