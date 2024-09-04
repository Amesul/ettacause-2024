<x-app-layout>
    <x-slot name="header">
        <p>
            {{ __('Participant·es') }}
        </p>
    </x-slot>

    <form action="{{ route('streamers.store') }}" method="post">
        @csrf
        <div class="mb-2 text-black">
            <label for="login" class="block font-semibold leading-3">Noms d'utilisateurs Twitch :</label>
            <p><span class="font-normal italic text-sm ">(séparés par des virgules)</span></p>
        </div>
        <x-text-input id="login" name="login" class="mt-2 bg-white border-slate-500 mr-4 text-black" autofocus autocomplete="off"/>
        <x-primary-button>
            Ajouter
        </x-primary-button>
    </form>
    <div class="bg-white mt-8 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="py-2 text-gray-900 w-full" role="table">
            <div class="grid">
                @foreach($streamers as $streamer)
                    <div
                        class="flex justify-between gap-8 py-4 px-6 {{ $loop->first ? '' : 'border-t' }}">
                        <div>
                            <button onclick="fetchImageAndDownload(this)"
                                    data_url="{{ $streamer['profile_image_url'] }}"
                                    data_name="{{ $streamer['login'] }}_avatar.png">
                                <img src="{{ $streamer['profile_image_url'] }}" alt="{{ $streamer['login'] }}_avatar"
                                     class="w-14 rounded-full cursor-pointer">
                            </button>
                        </div>
                        <div class="grid content-center w-28 overflow-hidden">
                            <h3 class="font-semibold truncate">
                                <a href="https://twitch.tv/{{ $streamer['login'] }}"
                                   target="_blank">{{ $streamer['display_name'] }}</a>
                            </h3>
                        </div>
                        <div class="flex-1 grid content-center">
                            <p class="line-clamp-2">{{ $streamer['description'] }}</p>
                        </div>
                        <div class="grid content-center">
                            <form action="{{ route('streamers.destroy', $streamer['login']) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-semibold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function fetchImageAndDownload(e) {
            const url = e.attributes['data_url'].nodeValue;
            const filename = e.attributes['data_name'].nodeValue;
            const img = document.createElement("img");   // Create in-memory image
            img.addEventListener("load", () => {
                const a = document.createElement("a");   // Create in-memory anchor
                a.href = img.src;                        // href toward your server-image
                a.download = filename;               // :)
                a.click();                               // Trigger click (download)
            });
            img.src = 'fetchimage?url=' + url;       // Request image from your server
        }
    </script>
</x-app-layout>
