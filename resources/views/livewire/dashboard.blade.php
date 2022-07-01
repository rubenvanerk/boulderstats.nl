<div>
    @if($users->isEmpty() || $addUser)
        @if ($users->isNotEmpty())
            <x-button wire:click="$set('addUser', false)">
                Cancel
            </x-button>
        @endif

        <livewire:add-user/>
    @else
        <x-button wire:click="$set('addUser', true)">
            Add user
        </x-button>

        <x-stats :users="$users"/>
    @endif
</div>
