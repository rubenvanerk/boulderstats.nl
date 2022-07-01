<div>
    <div class="w-full space-y-5">
        <div>
            <x-label>Select a gym</x-label>
            <select wire:model="gymId" class="w-full">
                <option></option>
                @foreach ($gyms as $gym)
                    <option value="{{ $gym->id }}">{{ $gym->name }} {{ $gym->city ? ' - ' . $gym->city : '' }}</option>
                @endforeach
            </select>
        </div>

        <div wire:loading wire:target="gymId" class="animate-pulse">Fetching users</div>

        <div wire:loading.remove wire:target="gymId">
            @if ($gymId && $users->count() > 0)
                <x-label>Select a user</x-label>
                <select wire:model="userId" class="w-full">
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
            @elseif($gymId)
                <div>No users found in this gym</div>
            @endif
        </div>

        @if($userId && $gymId)
            <x-button wire:click="submit">
                Add user
            </x-button>
        @endif

    </div>
</div>
