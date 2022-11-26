@props(['userIds'])

<div class="flex overflow-y-hidden overflow-x-scroll space-x-5">

    @foreach($userIds as $userId)
        <livewire:user-stats :userId="$userId" :wire:key="$userId"/>
    @endforeach

</div>
