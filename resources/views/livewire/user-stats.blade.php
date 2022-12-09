<div wire:init="loadStats" class="flex flex-col items-center pb-2 w-40">
    <div class="text-2xl font-bold text-gray-800 sm:text-3xl sm:truncate sticky top-0 py-2 flex items-center">
        {{ $user->firstName }}
        <x-icons.x-circle wire:click="remove" class="block ml-2 h-6 w-6 hover:text-gray-500 hover:cursor-pointer"></x-icons.x-circle>
    </div>

    <div class="w-full space-y-5">
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

        @if($readyToLoad)
            <div>
                <h2 class="text-gray-700 font-semibold text-lg text-center">Top 10 <sup class="text-xs text-gray-500 font-normal">60d</sup></h2>
            </div>

            <div class="flex flex-col space-y-1 w-40">
                @foreach($user->stats->topTen as $ascend)
                    <li class="relative col-span-1 flex shadow-sm rounded-md border border-gray-200 ">
                        <div
                            class="flex-shrink-0 flex items-center justify-center w-10 text-white text-sm font-bold rounded-l-md [text-shadow:_0_0_5px_dimgray]"
                            style=" background-color: {{ $ascend->color }}; ">
                            {{ $ascend->gradeFont }}
                        </div>
                        <div
                            class="flex-1 flex items-center justify-between border-l border-gray-200 bg-white rounded-r-md truncate">
                            <div class="flex-1 px-2 py-0.5 text-sm truncate">
                                <span class="text-gray-600 font-medium">
                                    {{ $ascend->wallName }}
                                </span>
                            </div>
                            @if ($ascend->checks === 2)
                                <x-icons.bolt class="text-amber-500 w-4 h-4 mr-1"></x-icons.bolt>
                            @endif
                        </div>
                    </li>
                @endforeach
            </div>
        @endif
    </div>

</div>
