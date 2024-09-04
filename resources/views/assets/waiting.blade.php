<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Waiting</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/assets.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen bg-cover">
<main class="flex h-screen w-screen flex-col items-center justify-center bg-black/50">
    @if($selector === 'intro')
        <section class="mb-20 h-fit rounded-2xl px-12 py-10 text-lime-50">
            <h2 class="text-9xl mask font-staatliches">Le live va</h2>
            <h2 class="ml-44 text-9xl mask font-staatliches">commencer...</h2>
        </section>
    @elseif($selector === 'pause')
        <section class="mb-20 h-fit rounded-2xl px-12 py-10 text-lime-50">
            <h2 class="text-9xl mask font-staatliches">Je reviens dans</h2>
            <h2 class="ml-96 text-9xl mask font-staatliches">un instant...</h2>
        </section>
    @elseif($selector === 'outro')
        <section class="mb-10 h-fit rounded-2xl px-12 py-10 text-lime-50">
            <h2 class="text-9xl mask font-staatliches">Le live est terminé !</h2>
        </section>
    @endif

    <section class="flex gap-44">
        <img class="h-44" src="{{ asset('/storage/images/logo_ETC-full-flat.png') }}">
        <img class="h-44" src="{{ asset('/storage/images/logo_EAT.png') }}">
    </section>

    <section
        class="absolute bottom-0 left-0 flex h-28 w-full justify-between gap-8 border-t-4 bg-black/50 px-8 backdrop-brightness-50 backdrop-blur-5xl border-secondary">
        <div class="flex items-center gap-8">
            <img class="h-20" src="{{ asset('/storage/images/logo_resonances-full.png') }}">
            <img class="h-20" src="{{ asset('/storage/images/logo_mixtape-records-full.png') }}">
        </div>
        <div class="flex h-28 items-center gap-8">
            <!-- Cagnotte globale -->
            <div class="relative h-16 w-56">
                <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-gray-950 text-primary font-staatliches">
                    Cagnotte perso</p>
                <div
                    class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-white shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                    <p class="mt-2 h-fit w-fit">12 359,45 €</p>
                </div>
            </div>
            <!-- Cagnotte globale -->
            <div class="relative h-16 w-56">
                <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-gray-950 text-primary font-staatliches">
                    Cagnotte globale</p>
                <div
                    class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-white shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                    <p class="mt-2 h-fit w-fit">456 461,89 €</p>
                </div>
            </div>
        </div>
    </section>
</main>
</body>

</html>
