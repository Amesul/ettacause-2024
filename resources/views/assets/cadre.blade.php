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

<body class="h-screen w-screen bg-none">

@if($_REQUEST['color'] === 'secondary')
    <div class="h-full w-full border-4 border-secondary block"></div>
@elseif($_REQUEST['color'] === 'violet')
    <div class="h-full w-full border-4 border-primary block"></div>
@elseif($_REQUEST['color'] === 'blanc')
    <div class="h-full w-full border-4 border-stone-100 block"></div>
@elseif($_REQUEST['color'] === 'noir')
    <div class="h-full w-full border-4 border-stone-950 block"></div>
@endif

</body>

</html>
