<div>
    <div class="w-full space-y-5">
        <div>
            <x-label>Pick your gym</x-label>
            <select wire:model="gymId" class="w-full">
                <option></option>
                @foreach ($gyms as $gym)
                    <option value="{{ $gym['id'] }}">{{ $gym['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div wire:loading wire:target="gymId" class="animate-pulse">Fetching users</div>

        <div wire:loading.remove wire:target="gymId">
            @if ($gymId && $users->count() > 0)
                <x-label>Pick a user</x-label>
                <select wire:model="userId" class="w-full">
                    <option value=""></option>
                    @foreach ($users as $user)
                        <option value="{{ $user['uid'] }}">{{ $user['full_name'] }}</option>
                    @endforeach
                </select>
            @elseif($gymId)
                <div>No users found in this gym</div>
            @endif
        </div>

        @if($userId && $gymId)
            <x-button wire:click="submit">
                View stats
            </x-button>
        @endif

    </div>
</div>
