<section id="event"
         class="mb-0 grid w-full content-end bg-gray-950/80 px-24 py-4 text-xl font-raleway">
    <div class="w-3/4">
        <header class="flex items-baseline">
            <h2 class="truncate text-4xl font-staatliches text-stone-100">
                Prochaine émission : {{ $event->title }}
            </h2>
        </header>
        <p class="font-black text-primary mb-2">{{ ucfirst($event->date->addHours(-2)->diffForHumans()) }}</p>
        <p class="line-clamp-2 text-stone-100 font-medium">{{ $event->description }}</p>
    </div>
</section>
