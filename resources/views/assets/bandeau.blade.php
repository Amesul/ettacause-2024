<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bandeau</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen w-screen overflow-hidden bg-none">

<section id="bot_command_container"
         class="absolute bottom-24 left-20 flex translate-y-12 justify-center rounded-t-lg px-6 pt-2 pb-6 align-middle shadow-lg transition-all ease-in-out duration-[2s] bg-slate-600 min-w-28">
    <p id="bot_command" class="font-bold text-stone-100 font-raleway"></p>
</section>

<main
    class="absolute bottom-0 left-0 z-20 flex h-28 w-full justify-between border-t-4 px-8 shadow-lg bg-slate-950 border-secondary">
    <div class="flex h-28 items-center gap-8">
        <img class="h-20" src="{{ asset('/storage/images/logo_ETC-full-flat.png') }}">
        <!-- Cagnotte globale -->
        <div class="relative h-16 w-56">
            <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-slate-950 text-primary font-staatliches">
                Cagnotte globale</p>
            <div
                class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-white shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                <p class="mt-2 h-fit w-fit"></p>
            </div>
        </div>
        @if($cagnotte_perso)
            <!-- Cagnotte perso -->
            <div class="relative h-16 w-56">
                <p class="absolute left-1/2 inline-block -translate-x-1/2 truncate bg-none px-1 text-2xl font-medium -top-[14px] bg-slate-950 text-primary font-staatliches">
                    Cagnotte perso</p>
                <div
                    class="inline-flex h-full w-full place-items-center justify-center truncate rounded-md border-0 text-3xl text-stone-100 shadow-sm ring-2 ring-inset py-1.5 font-staatliches ring-primary">
                    <p class="mt-2 h-fit w-fit"></p>
                </div>
            </div>
        @endif
        <img class="h-20" src="{{ asset('/storage/images/logo_EAT.png') }}">
    </div>

    <div class="flex items-center gap-8">
        <img class="h-20 rounded-lg" src="{{ asset('/storage/images/logo_twitchat.png') }}">
        {{-- <img class="hidden h-20" src="{{ asset('/storage/images/logo_twitchat-full.png') }}"> --}}
        <img class="h-20" src="{{ asset('/storage/images/logo_resonances.png') }}">
        {{-- <img class="hidden h-20" src="{{ asset('/storage/images/logo_resonances-full.png') }}"> --}}
        <img class="h-20" src="{{ asset('/storage/images/logo_mixtape-records.png') }}">
        {{-- img class="hidden h-20" src="{{ asset('/storage/images/logo_mixtape-records-full.png') }}"> --}}
        <div class="relative -ml-2 h-20 w-56">
            <img src="{{ asset('storage/images/tshirt_V1.png') }}"
                 class="absolute -bottom-24 rotate-6 -skew-x-3 z-50 drop-shadow-[0px_2px_15px_rgba(245,245,244,0.18)] brightness-110 contrast-125">
        </div>
    </div>
</main>

<script>
    // Durée d'affichage de la bulle de texte, en secondes (3s minimum)
    const duration = 8;
    // Intervalle entre chaque bulle de texte, en secondes (doit être supérieur d'au moins 2s à la durée)
    const interval = 300;

    // Liste des textes à afficher
    const commands = [
        'don',
        'tshirt',
        'album',
        'eat',
        'etc',
    ];

    const container = document.querySelector('#bot_command_container');
    const text = document.querySelector('#bot_command');
    let index = 0;

    setInterval(() => {
        index += 1;
        if (index >= commands.length) {
            index = 0;
        }
        text.innerText = `!${commands[index]}`;
        container.classList.remove('translate-y-12');
        setTimeout(() => {
            container.classList.add('translate-y-12');
        }, duration * 1000);
    }, interval * 1000)
</script>

</body>
</html>
