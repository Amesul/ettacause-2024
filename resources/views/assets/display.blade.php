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

    <title>Display</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/assets.css'])
</head>

<body class="overflow-hidden antialiased w-[1920px] h-[1080px]">

<main class="flex h-full flex-col justify-between bg-black/50 pt-10">
    @include('assets.partials.streamers')
    @include('assets.partials.event')
</main>
</body>

<script>
    setInterval(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'patch',
            url: '{{ route('assets.streamers.update') }}'
        })
            .done(function (data) {
                $('#streamers').replaceWith(data);
            });
    }, 5 * 60 * 1000)

    setInterval(function () {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'patch',
            url: '{{ route('assets.events.update')}}'
        })
            .done(function (data) {
                $('#event').replaceWith(data);
            });
    }, 30 * 1000)
</script>
</html>
