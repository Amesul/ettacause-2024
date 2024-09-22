<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bandeau (logos complets)</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen overflow-hidden bg-transparent">
<main
    class="absolute bottom-0 left-0 flex h-28 w-full justify-between border-t-4 px-8 bg-gray-950 border-secondary">
    <div class="flex items-center gap-8">
        <img class="h-16 rounded-lg" src="{{ asset('/storage/images/logo_twitchat-full.png') }}">
        <img class="h-16" src="{{ asset('/storage/images/logo_resonances-full.png') }}">
        <img class="h-16" src="{{ asset('/storage/images/logo_mixtape-records-full.png') }}">
    </div>
    <div class="flex h-28 items-center gap-8">
        <!-- Cagnotte globale -->
        <div class="relative h-16 w-56">
            <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-gray-950 text-primary font-staatliches">
                Cagnotte globale</p>
            <div
                class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-white shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                <p class="mt-2 h-fit w-fit"></p>
            </div>
        </div>
        <!-- Cagnotte globale -->
        <div class="relative h-16 w-56">
            <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-gray-950 text-primary font-staatliches">
                Cagnotte perso</p>
            <div
                class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-white shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                <p class="mt-2 h-fit w-fit"></p>
            </div>
        </div>
        <div class="relative -ml-4 h-20 w-56">
            <img class="absolute -bottom-24 rotate-6 -skew-x-3 z-10 brightness-110 contrast-125"
                 src="{{ asset('storage/images/tshirt_V1.png') }}" alt="T-shirt">
        </div>
    </div>
</main>
</body>

</html>
