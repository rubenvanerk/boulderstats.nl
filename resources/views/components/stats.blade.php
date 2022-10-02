@props(['userIds'])

<div class="grid grid-rows-5 grid-flow-col gap-x-5 overflow-y-hidden overflow-x-scroll">

    <div class="px-3 py-3"></div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">60d Grade</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Tops</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Sessions</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Tops/Session</div>

    @foreach($userIds as $userId)
        <livewire:user-stats :userId="$userId"/>
    @endforeach

</div>
