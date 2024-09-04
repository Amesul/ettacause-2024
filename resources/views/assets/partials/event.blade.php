<section id="event"
         class="mb-0 grid w-full content-end bg-black/70 px-24 py-4 text-xl backdrop-blur-3xl font-raleway ">
    <div class="w-3/4">
        <header class="flex items-baseline">
            <h2 class="truncate text-4xl font-staatliches text-stone-100">
                Prochaine émission : {{ $event->title }}
            </h2>
            <div class="grid content-center">
                <div class="isolate p-2 ml-6 flex w-max justify-end overflow-hidden -space-x-3">
                    @foreach($event->streamers as $streamer)
                        <img src="{{ $streamer->profile_image_url }}"
                             alt="{{ $streamer->display_name }}"
                             class="relative bg-transparent inline-block h-6 w-6 rounded-full ring-2 ring-stone-100">
                    @endforeach
                </div>
            </div>
        </header>
        <p class="font-black text-primary mb-2">{{ ucfirst($event->date->addHours(-1)->diffForHumans()) }}</p>
        <p class="line-clamp-2 text-stone-100 font-medium">{{ $event->description }}</p>
    </div>
</section>
