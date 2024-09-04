@php use Illuminate\Support\Facades\Vite; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full w-full bg-gray-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="/storage/assets/tmi.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full antialiased bg-hero">

@if (Session::has('info'))
    <x-flash type="info">{{ Session::get('info') }}</x-flash>
@elseif(Session::has('danger'))
    <x-flash type="danger">{{ Session::get('danger') }}</x-flash>
@elseif(Session::has('success'))
    <x-flash type="success">{{ Session::get('success') }}</x-flash>
@endif

<div class="min-h-full bg-stone-100">
    <nav class="bg-black">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 justify-between">
                <div class="flex">
                    <div class="flex flex-shrink-0 items-center">
                        <x-application-logo class="h-8"/>
                    </div>
                    <div class="hidden sm:space-x-8 sm:-my-px sm:ml-6 sm:flex">
                        <x-nav-link active="{{ $request->is('profile*') }}" href="{{ route('profile.edit') }}">Profil
                        </x-nav-link>
                        <x-nav-link active="{{ $request->is('streamers*') }}" href="{{ route('streamers.index') }}">
                            Streameur·euses
                        </x-nav-link>
                        <x-nav-link active="{{ $request->is('events*') }}" href="{{ route('events.index') }}">Programme
                        </x-nav-link>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">

                    <!-- Logout -->
                    <div class="relative ml-3">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button
                                class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-lg text-gray-400 font-bold font-dosis hover:border-red-500 hover:text-white">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
                <div class="-mr-2 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <button type="button"
                            class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Menu open: "hidden", Menu closed: "block" -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                        <!-- Menu open: "block", Menu closed: "hidden" -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="sm:hidden" id="mobile-menu">
            <div class="pt-2 pb-3 space-y-1">
                <x-nav-link-mobile active="{{ $request->is('profile*') }}" href="{{ route('profile.edit') }}">
                    Profil
                </x-nav-link-mobile>
                <x-nav-link-mobile active="{{ $request->is('streamers*') }}" href="{{ route('streamers.index') }}">
                    Streameur·euses
                </x-nav-link-mobile>
                <x-nav-link-mobile active="{{ $request->is('events*') }}" href="{{ route('events.index') }}">
                    Programme
                </x-nav-link-mobile>
            </div>
            <div class="border-t border-gray-200 pt-4 pb-3">

            </div>
        </div>
    </nav>

    <div class="">
        <header class="bg-black w-full h-full text-stone-100">
            <div class="py-5 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mb-4 ">
                <h1 class="text-4xl leading-tight tracking-tight font-staatliches text-stone-100">{{ $header }}</h1>
            </div>
        </header>

        <div class="flex w-full items-center h-8 bg-repeat-xbg-stone-100 bg-div"
             style="background-image: url('{{ Vite::asset('resources/images/div.png') }}');"></div>

        <main class="bg-stone-100 h-full py-10">
            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    @include('layouts.footer')

</div>

</body>
</html>
