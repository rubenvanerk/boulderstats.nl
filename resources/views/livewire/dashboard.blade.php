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

        <div>
            @foreach($users as $user)
                {{ $user->fullName }}<br/>
            @endforeach
        </div>
    @endif
</div>
