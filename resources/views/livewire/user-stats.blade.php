<div wire:init="loadStats" class="flex flex-col items-center pb-2 w-40">
    <div class="text-2xl font-bold text-gray-800 sm:text-3xl sm:truncate sticky top-0 py-2 flex items-center">
        {{ $user->firstName }}
        <x-icons.x-circle wire:click="remove" class="block ml-2 h-6 w-6 hover:text-gray-500 hover:cursor-pointer"></x-icons.x-circle>
    </div>

    <div class="w-full space-y-5">
        <x-dashboard.stats :$readyToLoad :$gradeFont60d :$gradeProgression60d :$user/>

        @if($readyToLoad)
            <x-dashboard.ascends-list :ascends="$user->stats->topTen"/>
        @endif
    </div>

</div>
