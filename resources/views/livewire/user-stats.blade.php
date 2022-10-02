<div wire:init="loadStats" class="flex flex-col items-center">
    <div class="text-2xl font-bold text-gray-800 sm:text-3xl sm:truncate sticky py-2">
        {{ $user->firstName . ' ' . $user->lastName }}
    </div>
    @if($readyToLoad)
        <div class="relative py-3">
            <div class="relative mx-auto max-w-7xl px-4">
                <div class="mx-auto max-w-4xl">
                    <dl class="rounded-lg bg-gray-50 shadow">
                        <div class="flex flex-col border-b border-gray-100 p-6 text-center">
                            <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">60d grade</dt>
                            <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600">
                                {{ $gradeFont60d }}
                                <sup class="text-gray-400 text-xs font-semibold">+{{ $gradeProgression60d }}%</sup>
                            </dd>
                        </div>
                        <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center">
                            <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Tops</dt>
                            <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600">{{ $user?->ascends?->count() }}</dd>
                        </div>
                        <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center">
                            <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Sessions</dt>
                            <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600">{{ $user->stats->sessionCount ?: '?' }}</dd>
                        </div>
                        <div class="flex flex-col border-t border-gray-100 p-6 text-center">
                            <dt class="order-2 mt-1 tracking-wide text-sm font-medium text-gray-500">Tops/session</dt>
                            <dd class="order-1 text-3xl font-bold tracking-tight text-primary-600">{{ round($user?->ascends?->count() / $user?->stats?->sessionCount, 1) ?? '?' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    @endif
</div>
