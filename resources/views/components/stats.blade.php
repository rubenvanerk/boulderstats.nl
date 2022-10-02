@props(['userIds'])

<div class="flex overflow-y-hidden overflow-x-scroll">

    @foreach($userIds as $userId)
        <livewire:user-stats :userId="$userId"/>
    @endforeach

</div>
