<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Waiting</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen overflow-hidden bg-transparent">
<main class="flex h-screen w-screen flex-col items-center justify-center">
    @if($selector === 'intro')
        <section class="mb-20 h-fit rounded-2xl px-12 py-10 text-lime-50 drop-shadow-2xl">
            <h2 class="text-9xl mask font-staatliches">Le live va commencer...</h2>
        </section>
    @elseif($selector === 'pause')
        <section class="mb-20 h-fit rounded-2xl px-12 py-10 text-lime-50 drop-shadow-2xl">
            <h2 class="text-9xl mask font-staatliches">Je reviens dans un instant...</h2>
        </section>
    @elseif($selector === 'outro')
        <section class="mb-10 h-fit rounded-2xl px-12 py-10 text-lime-50 drop-shadow-2xl">
            <h2 class="text-9xl mask font-staatliches">Le live est terminé !</h2>
        </section>
    @endif

    <section class="flex gap-44">
        <img class="h-44 drop-shadow-2xl" src="{{ asset('/storage/images/logo_ETC-full-flat.png') }}">
        <img class="h-44 drop-shadow-2xl" src="{{ asset('/storage/images/logo_EAT.png') }}">
    </section>
</main>
</body>

</html>
