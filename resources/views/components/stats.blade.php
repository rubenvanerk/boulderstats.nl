@props(['users'])

<div class="grid grid-rows-5 grid-flow-col gap-x-5 overflow-scroll">
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500"></div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">60d Grade</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Tops</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Sessions</div>
    <div class="px-3 py-3 text-xs font-medium uppercase tracking-wide text-gray-500">Tops/Session</div>

    @foreach($users as $user)
        <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">{{ $user->fullName }}</span>
        <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">{{ $user->stats->grade }}</span>
        <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">6ʙ⁺</span>
        <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">6ʙ⁺</span>
        <span class="text-2xl font-extrabold text-primary-600 sm:text-3xl">6ʙ⁺</span>
    @endforeach

</div>
