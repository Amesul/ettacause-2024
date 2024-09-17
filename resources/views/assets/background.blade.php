<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Background</title>

    @vite('resources/css/gradient.css')
</head>

<body class="h-screen w-screen overflow-hidden">

<main id="mesh-gradient" class="elements"></main>
@vite('resources/js/gradient.js')

</body>

</html>
