@props(['ascends'])

<div>
    <h2 class="text-gray-700 font-semibold text-lg text-center">Top 10 <sup class="text-xs text-gray-500 font-normal">60d</sup></h2>
</div>

<div class="flex flex-col space-y-1 w-40">
    @foreach($ascends as $ascend)
        <li class="relative col-span-1 flex shadow-sm rounded-md border border-gray-200 ">
            <div
                class="flex-shrink-0 flex items-center justify-center w-10 text-white text-sm font-bold rounded-l-md [text-shadow:_0_0_5px_dimgray]"
                style=" background-color: {{ $ascend->color }}; ">
                {{ $ascend->gradeFont }}
            </div>
            <div
                class="flex-1 flex items-center justify-between border-l border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-2 py-0.5 text-sm truncate">
                                <span class="text-gray-600 font-medium">
                                    {{ $ascend->wallName }}
                                </span>
                </div>
                @if ($ascend->checks === 2)
                    <x-icons.bolt class="text-amber-500 w-4 h-4 mr-1"></x-icons.bolt>
                @endif
            </div>
        </li>
    @endforeach
</div>
