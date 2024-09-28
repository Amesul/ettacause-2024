<section id="streamers" class="relative" x-data="pagination">
    <ul class="absolute top-0 left-0 grid w-full grid-cols-8 gap-y-14 gap-4 p-8" x-show="page === 1"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 "
        x-transition:enter-end="opacity-100 "
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        @foreach($streamers as $streamer)
            @if($streamer->login !== 'ettacause' && $loop->iteration <= 40)
                <li>
                    <figure class="h-28 {{ $streamer->online ? '' : 'opacity-45' }}"
                            id="{{ $streamer->id }}">
                        <div class="container relative">
                            <img src="{{ $streamer->profile_image_url }}" alt=""
                                 class=" rounded-full w-20 m-auto {{ $streamer->online ? 'outline' : '' }} outline-2 outline-secondary/35 z-20 outline-offset-4">
                            <span
                                class="rounded-full w-20 h-20 absolute top-0 inset-0 m-auto {{ $streamer->online ? 'outline' : '' }} z-10 outline-2 outline-secondary animate-pulse outline-offset-4"></span>
                        </div>
                        <figcaption class="max-h-20 w-full overflow-hidden">
                            <p class="text-center mt-1 {{ $streamer->online ? 'text-stone-100' : 'text-slate-300' }} text-lg font-raleway font-bold">{{ $streamer->display_name }}
                                <span
                                    class="{{ $streamer->online ? '' : 'hidden' }} bg-primary relative z-20 ml-2 w-2 h-2 inline-block rounded-full">
                                        <span
                                            class="absolute top-0 left-0 z-10 inline-block h-2 w-2 animate-ping rounded-full bg-primary"></span>
                                    </span>
                            </p>
                        </figcaption>
                    </figure>
                </li>
            @endif
        @endforeach
    </ul>
    <ul class="absolute top-0 left-0 grid w-full grid-cols-8 gap-y-14 gap-4 p-8" x-show="page === 2"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 "
        x-transition:enter-end="opacity-100 "
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        @foreach($streamers as $streamer)
            @if($streamer->login !== 'ettacause' && $loop->iteration > 40)
                <li>
                    <figure class="h-28 {{ $streamer->online ? '' : 'opacity-45' }}"
                            id="{{ $streamer->id }}">
                        <div class="container relative">
                            <img src="{{ $streamer->profile_image_url }}" alt=""
                                 class=" rounded-full w-20 m-auto {{ $streamer->online ? 'outline' : '' }} outline-2 outline-secondary/35 z-20 outline-offset-4">
                            <span
                                class="rounded-full w-20 h-20 absolute top-0 inset-0 m-auto {{ $streamer->online ? 'outline' : '' }} z-10 outline-2 outline-secondary animate-pulse outline-offset-4"></span>
                        </div>
                        <figcaption class="max-h-20 w-full overflow-hidden">
                            <p class="text-center mt-1 {{ $streamer->online ? 'text-stone-100' : 'text-slate-300' }} text-lg font-raleway font-bold">{{ $streamer->display_name }}
                                <span
                                    class="{{ $streamer->online ? '' : 'hidden' }} bg-primary relative z-20 ml-2 w-2 h-2 inline-block rounded-full">
                                        <span
                                            class="absolute top-0 left-0 z-10 inline-block h-2 w-2 animate-ping rounded-full bg-primary"></span>
                                    </span>
                            </p>
                        </figcaption>
                    </figure>
                </li>
            @endif
        @endforeach
    </ul>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('pagination', () => ({
            page: 1,
            interval: 15, // Intervalle en secondes

            // Fonction auto-exécutée pour démarrer le carousel automatiquement
            init() {
                this.page = 1;
                (() => {
                    setInterval(() => {
                        this.page = 2;
                        setTimeout(() => {
                            this.page = 1
                        }, this.interval * 1000)
                    }, this.interval * 2 * 1000);
                })();
            },
        }));
    });
</script>
