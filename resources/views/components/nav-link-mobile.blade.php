@props(['active'])

<a {{ $attributes }}
   class="{{ ($active ?? false) ? 'border-primary bg-stone-100 text-primary' : 'border-transparent hover:border-gray-700 hover:bg-stone-100/20 hover:text-gray-100 text-gray-400' }} transition-all block border-l-4 py-2 pl-3 pr-4 text-base">
    {{ $slot }}
</a>
