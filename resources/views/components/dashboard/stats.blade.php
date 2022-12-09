@props(['user', 'readyToLoad', 'gradeFont60d', 'gradeProgression60d'])

<dl class="rounded-lg bg-white shadow">
    <div class="flex flex-col border-b border-gray-100 p-6 text-center">
        <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">60d grade</dt>
        <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600" wire:loading.class="animate-pulse">
            {{ $readyToLoad ? $gradeFont60d : '...' }}
            <sup class="text-gray-400 text-xs font-semibold">
                {{ $readyToLoad ? '+' . $gradeProgression60d . '%' : '' }}
            </sup>
        </dd>
    </div>
    <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center">
        <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Tops</dt>
        <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600" wire:loading.class="animate-pulse">
            {{  $readyToLoad ? $user?->ascends?->count() : '...' }}
        </dd>
    </div>
    <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center">
        <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Sessions</dt>
        <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600" wire:loading.class="animate-pulse">
            {{  $readyToLoad ? ($user->stats->sessionCount ?: '?') : '...' }}
        </dd>
    </div>
    <div class="flex flex-col border-t border-gray-100 p-6 text-center">
        <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Tops/session</dt>
        <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600" wire:loading.class="animate-pulse">
            @if($readyToLoad)
                {{ round($user?->ascends?->count() / $user?->stats?->sessionCount, 1) ?? '?' }}
            @else
                ...
            @endif
        </dd>
    </div>
</dl>
