<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cadre</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css'])

</head>

<body class="h-screen w-screen overflow-hidden bg-none">

@if($color === 'turquoise')
    <div class="block h-full w-full border-4 border-secondary"></div>
@elseif($color === 'violet')
    <div class="block h-full w-full border-4 border-primary"></div>
@elseif($color === 'blanc')
    <div class="block h-full w-full border-4 border-stone-100"></div>
@elseif($color === 'noir')
    <div class="block h-full w-full border-4 border-stone-950"></div>
@endif

</body>

</html>
