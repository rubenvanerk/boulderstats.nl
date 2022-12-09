<div>
    @if(!$userIds || $addUser)
        @if ($userIds)
            <x-button wire:click="$set('addUser', false)">
                Cancel
            </x-button>
        @endif

        <livewire:add-user/>
    @else
        <x-button wire:click="$set('addUser', true)">
            Add user
        </x-button>

        <x-button wire:click="refresh">
            Refresh
        </x-button>

        <div class="flex overflow-y-hidden overflow-x-scroll space-x-5">

            @foreach($userIds as $userId)
                <livewire:user-stats :userId="$userId" :wire:key="$userId"/>
            @endforeach

        </div>
    @endif
</div>
