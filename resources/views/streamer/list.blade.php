<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/d27584343e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Liste</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-800 antialiased w-full h-full">

<main class="flex h-full flex-col justify-between py-16 px-24">
    <h1 class="text-stone-100 font-staatliches text-5xl">Liste des participant·es</h1>
    <p class="font-raleway text-red-500 font-bold text-xl mb-12 mt-2">Ne pas diffuser !</p>
    <ul class="grid w-full grid-cols-8 gap-x-16 gap-y-20">
        @foreach($streamers as $streamer)
            @if($streamer->login !== 'ettacause')
                <li>
                    <a href="https://twitch.tv/{{ $streamer->login }}" target="_blank">
                        <figure class="h-28 {{ $streamer->online ? '' : 'opacity-35' }}"
                                id="{{ $streamer->id }}">
                            <div class="container relative">
                                <img src="{{ $streamer->profile_image_url }}" alt=""
                                     class=" rounded-full w-24 m-auto {{ $streamer->online ? 'outline' : '' }} outline-2 outline-secondary/35 z-24 outline-offset-4">
                                <span
                                    class="rounded-full w-24 h-24 absolute top-0 inset-0 m-auto {{ $streamer->online ? 'outline' : '' }} z-10 outline-2 outline-secondary animate-pulse outline-offset-4"></span>
                            </div>
                            <figcaption class="max-h-24 w-full overflow-hidden">
                                <p class="text-center mt-1 {{ $streamer->online ? 'text-stone-100' : 'text-slate-300' }} text-lg font-raleway font-bold">{{ $streamer->display_name }}
                                    <span
                                        class="{{ $streamer->online ? '' : 'hidden' }} bg-primary relative z-24 ml-2 w-2 h-2 inline-block rounded-full">
                                        <span
                                            class="absolute top-0 left-0 z-10 inline-block h-2 w-2 animate-ping rounded-full bg-primary"></span>
                                    </span>
                                </p>
                            </figcaption>
                        </figure>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</main>
</body>

</html>
