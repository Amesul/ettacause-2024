<x-app-layout>
    <x-slot name="header">
        <p>
            {{ __('Programme') }}
        </p>
        <div class="text-end">
            <x-primary-link href="{{ route('event.create') }}">
                Ajouter
            </x-primary-link>
        </div>
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="py-2 text-gray-900 w-full" role="table">
            <div class="grid">
                @foreach($events as $event)
                    <div class="flex justify-between gap-4 py-4 px-6 {{ $loop->first ? '' : 'border-t' }}">
                        <div class="grid content-start w-32 overflow-hidden leading-5">
                            <p class="truncate mb-2">
                                @php($semaine = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"))
                                {{ $semaine[$event['date']->format('w')] . ', ' . $event['date']->format('H:i') }}
                            </p>
                            <a href="{{ route('event.edit', $event) }}" class="text-blue-500 font-semibold">
                                Modifier
                            </a>
                            <form action="{{ route('event.destroy', $event) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-semibold">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                        <div class="grid content-start w-40 overflow-hidden group">
                            <h3 class="font-semibold leading-tight line-clamp-3">
                                {{ $event['title'] }}
                            </h3>
                        </div>
                        <div class="flex-1 grid content-start">
                            <p class="leading-tight line-clamp-3">{{ $event['description'] }}</p>
                        </div>
                        <div class="grid content-center">
                            <div class="isolate flex -space-x-2 overflow-hidden justify-end">
                                @foreach($event->streamers as $streamer)
                                    <img src="{{ $streamer->profile_image_url }}"
                                         alt="{{ $streamer->display_name }}"
                                         class="relative z-10 inline-block h-8 w-8 rounded-full ring-2 ring-white">
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
