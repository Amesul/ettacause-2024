@props(['active'])

<a {{ $attributes }}
   class="{{ ($active ?? false) ? "font-bold text-stone-100 border-primary" : "border-transparent text-gray-400 font-medium hover:border-gray-700 hover:text-gray-300" }} text-lg  font-raleway inline-flex items-center border-b-2 px-1 pt-1">
    {{ $slot }}
</a>

