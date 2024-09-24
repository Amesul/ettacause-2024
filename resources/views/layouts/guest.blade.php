@php use Illuminate\Support\Facades\Vite; @endphp

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/d27584343e.js" crossorigin="anonymous"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&family=Staatliches&display=swap"
          rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black font-sans text-gray-900 antialiased">
@if (Session::has('info'))
    <x-flash type="info">{{ Session::get('info') }}</x-flash>
@elseif(Session::has('danger'))
    <x-flash type="danger">{{ Session::get('danger') }}</x-flash>
@elseif(Session::has('success'))
    <x-flash type="success">{{ Session::get('success') }}</x-flash>
@endif
<div class="flex min-h-screen w-full flex-col items-center bg-cover bg-center pt-6 sm:justify-center sm:pt-0"
     style="background-image: url('{{ Vite::asset('resources/images/hero.png') }}')">
    <div>
        <a href="{{ route('streamers.goals.create') }}">
            <x-application-logo class="h-24 fill-current text-gray-500"/>
        </a>
    </div>

    <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
