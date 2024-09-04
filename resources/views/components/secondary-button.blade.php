<button {{ $attributes->merge(['type' => 'button', 'class' => 'font-staatliches inline-flex items-center px-3 py-1 bg-primary text-white border border-transparent rounded-md uppercase tracking-wider hover:opacity-75 focus:opacity-75 active:opacity-75 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
