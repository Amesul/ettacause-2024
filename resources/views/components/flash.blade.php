@props([
    'type',
    ])

@php
    if($type === 'info') $color = 'bg-blue-200';
    elseif ($type === 'danger') $color = 'bg-red-200';
    elseif($type === 'success') $color ='bg-green-200';
@endphp

<div id="preloader" class="hidden bg-green-200 bg-red-200 bg-blue-200"></div>

<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 10000)"
     x-show="show"
     x-transition.opacity x-transition.duration.700ms
     class="fixed bottom-10 left-10 z-50 mt-2 flex origin-center items-center gap-4 rounded-xl bg-white px-4 py-2 shadow-lg">
    <div class="grid h-8 w-8 place-content-center rounded-full {{ $color }} text-lg">
        @if($type === 'info')
            <i class="fa-solid fa-circle-info"></i>
        @elseif($type === 'danger')
            <i class="fa-regular fa-circle-xmark"></i>
        @elseif($type === 'success')
            <i class="fa-regular fa-circle-check"></i>
        @endif
    </div>
    <p class="rounded-md {{ $color }} px-2 text-sm py-0.5">{{ $slot }}</p>
    <button @click="show = false"><i class="ml-3 text-base fa-solid fa-xmark"></i></button>
</div>
