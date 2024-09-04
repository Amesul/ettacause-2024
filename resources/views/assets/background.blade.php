<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Background</title>

    <!-- Scripts -->
    @vite(['resources/css/assets.css', 'resources/css/app.css'])
</head>

<body class="h-screen w-screen bg-cover">
</body>

</html>
