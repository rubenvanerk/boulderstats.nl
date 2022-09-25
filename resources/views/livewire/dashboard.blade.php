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

        <x-stats :user-ids="$userIds"/>
    @endif
</div>
