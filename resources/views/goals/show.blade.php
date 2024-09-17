<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="w-full">
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
<body class="h-screen w-full text-lg antialiased font-dosis">

@if (Session::has('info'))
    <x-flash type="info">{{ Session::get('info') }}</x-flash>
@elseif(Session::has('danger'))
    <x-flash type="danger">{{ Session::get('danger') }}</x-flash>
@elseif(Session::has('success'))
    <x-flash type="success">{{ Session::get('success') }}</x-flash>
@endif
<div class="min-h-screen bg-black">
    <div class="py-10">
        <!-- Page Content -->
        <main class="mx-auto my-8 grid max-w-7xl gap-8 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <section class="w-full p-6 text-gray-700">
                    <h2 class="font-bold">Cliquer pour copier</h2>
                    <p>Remplacer chaque bloc de code dans votre dashboard Streamlabs, comme indiqué dans le tutoriel
                        disponible sur le serveur Discord</p>
                </section>
            </div>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <section class="w-full p-6 text-gray-700">
                    <pre class="inline rounded-md px-2 py-1"><code class="cursor-pointer hover:text-gray-800"
                                                                   onclick="copyToClipboard(this.innerText, this)">&lt;!-- HTML --&gt;
&lt;div class='goal-cont'&gt;
    &lt;div id='goal-bar'&gt;
        &lt;span class='text' id='goal-current'&gt;&lt;/span&gt;
        &lt;span class='text' id='milestone-current'&gt;&lt;/span&gt;
        &lt;span class='text' id='goal-total'&gt;&lt;/span&gt;
        &lt;span id='bar'&gt;&lt;/span&gt;
    &lt;/div&gt;
    &lt;div&gt;
        &lt;span class='text' id='goal-current-solo'&gt;&lt;/span&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
                </section>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <section class="w-full p-6 text-gray-700">
                    <pre class="inline rounded-md px-2 py-1"><code class="cursor-pointer hover:text-gray-800"
                                                                   onclick="copyToClipboard(this.innerText, this)">/* CSS */
@import url('https://fonts.googleapis.com/css2?family=Staatliches&display=swap');

body {
    padding: 30px;
    box-sizing: border-box;
    font-family: 'Staatliches', sans-serif;
}

.text {
    font-family: 'Staatliches', sans-serif;
    font-weight: 500;
    color: #000;
    font-size: 20px;
    margin-top: auto;
    margin-bottom: auto;
    z-index: 10;
}

#goal-total {
    margin-right: 15px;
}

#goal-current {
    margin-left: 15px;
}

#milestone-current {
    flex: 1 1 0%;
    padding: 0 35px 0 35px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    text-align: center;
}

#goal-current-solo {
    color: rgb(247 254 231);
    font-size: 40px;
    position: fixed;
    right: 50%;
  transform: translateX(50%);
    top: 200px
}

#goal-bar {
    display: flex;
    width: 100%;
    height: 35px;
    background: #aaaaaa;
    position: relative;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
    border: solid 4px #92ffff;
}

#bar {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    background: #92ffff;
    opacity: 0;
    -webkit-box-shadow: 0px 0px 10px 1px rgba(146, 255, 255, 0.65);
    -moz-box-shadow: 0px 0px 10px 1px rgba(146, 255, 255, 0.65);
    box-shadow: 0px 0px 10px 1px rgba(146, 255, 255, 0.65);
}</code></pre>
                </section>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <section class="w-full p-6 text-gray-700">
                    <pre class="inline rounded-md px-2 py-1"><code class="cursor-pointer hover:text-gray-950"
                                                                   onclick="copyToClipboard(this.innerText, this)">{{ $js }}</code></pre>
                </section>
            </div>
        </main>
        <div id="message"
             class="fixed bottom-10 left-10 z-50 mt-2 flex origin-center items-center gap-4 rounded-xl bg-white px-4 py-2 opacity-0 shadow-lg transition-all"></div>
    </div>
</div>

</body>

<script>
    function copyToClipboard(text, target) {
        let message = document.querySelector('#message')
        navigator.clipboard.writeText(text).then(
            () => {
                message.innerHTML = "Copié !";
                message.classList.remove('opacity-0');
                message.classList.add('opacity-100');
            },
            () => {
                message.innerHTML = "Échec";
                message.classList.remove('opacity-0');
                message.classList.add('opacity-100');
            },
            setTimeout(() => {
                message.classList.add('opacity-0');
                message.classList.remove('opacity-100');
            }, 3500)
        );
    }
</script>
</html>
