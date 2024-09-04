<x-app-layout>
    <x-slot name="header">
        <p>
            {{ __('Programme') }}
        </p>
    </x-slot>

    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <section class="w-full p-6 text-gray-900">
            <header class="mb-8">
                <h2 class="text-xl font-medium text-gray-900">
                    Modifier "{{ $event->title }}"
                </h2>
            </header>
            <form action="{{ route('event.update', $event) }}" method="post">
                @method('PATCH')
                @csrf
                <fieldset class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Titre -->
                    <div>
                        <x-input-label for="title" :value="__('Titre')"/>
                        <x-text-input id="title" name="title" type="text" class="mt-1 w-64"
                                      :value="old('title', $event->title)" required autofocus
                                      autocomplete="none"/>
                        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                    </div>

                    <!-- Date -->
                    <div>
                        <x-input-label for="date" :value="__('Date')"/>
                        <input type="datetime-local" name="date" id="date"
                               value="{{$event->date}}"
                               min="2024-10-04T15:00"
                               max="2024-10-06T23:59"
                               class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-input-error class="mt-2" :messages="$errors->get('date')"/>
                    </div>

                    <!-- Participant·es -->
                    <div x-data="{show: false}">
                        <x-input-label>Participant·es</x-input-label>
                        <div class="flex gap-6">
                            <button @click.prevent="show = true"
                                    class="mt-1 block rounded-md border-slate-500 bg-slate-200 px-3 py-1">Modifier
                            </button>
                            <div class="isolate mt-1 flex items-center justify-end overflow-hidden py-1 -space-x-2">
                                @foreach($event->streamers as $streamer)
                                    <img src="{{ $streamer?->profile_image_url }}"
                                         alt="{{ $streamer?->display_name }}"
                                         class="relative z-10 inline-block h-8 w-8 rounded-full ring-2 ring-white">
                                @endforeach
                            </div>
                        </div>
                        <div class="absolute top-0 left-0 grid z-10 h-screen w-full bg-slate-900/80" x-show="show">
                            <fieldset class="m-auto w-full max-w-md rounded-md bg-white p-6 shadow-sm"
                                      @click.outside="show = false">
                                <p class="block text-base font-semibold leading-6 text-gray-900">
                                    Participant·es</p>
                                <fieldset class="mt-1">
                                    <x-input-label for="search" class="sr-only">Rechercher</x-input-label>
                                    <x-text-input type="text" name="search" id="search" class="flex-1"
                                                  oninput="updateList(this.value)"
                                                  placeholder="Rechercher par pseudo..." autocomplete="off"/>
                                </fieldset>
                                <div
                                    class="mt-8 h-96 overflow-y-auto border-t border-b border-gray-200 divide-y divide-gray-200">
                                    @foreach($streamers as $streamer)
                                        <div class="relative flex items-start py-4 streamer"
                                             id="{{ $streamer->login }}">
                                            <div class="relative mx-3 flex items-center">
                                                <div class="relative h-8 w-8"
                                                     x-data="{ selected: {{ $event->streamers()->find($streamer->id) ? 'true' : 'false' }} }">
                                                    <input id="{{ $streamer->login }}"
                                                           @click="selected = !selected"
                                                           name="streamers[{{$loop->iteration}}]"
                                                           type="checkbox"
                                                           :checked="selected"
                                                           value="{{ $streamer->id }}"
                                                           class="absolute top-0 z-20 h-8 w-8 rounded-full border-gray-300 bg-white/0 text-indigo-600/25 opacity-50">
                                                    <img src="{{ $streamer->profile_image_url }}"
                                                         alt="Profile picture"
                                                         class="absolute top-0 z-10 h-8 w-8 rounded-full"
                                                         :class="selected ? 'opacity-100' : 'opacity-25'">
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1 text-sm leading-6 my-auto">
                                                <label for="person-1"
                                                       class="select-none font-medium text-gray-900">
                                                    {{ $streamer->display_name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-8 text-end">
                                    <x-secondary-button @click.prevent="show = false">
                                        Enregistrer
                                    </x-secondary-button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </fieldset>

                <!-- Description -->
                <div class="mt-8">
                    <x-input-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description"
                              class="mt-1 h-28 w-full resize-none rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    >{{old('description', $event->description)}}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                </div>

                <div class="mt-8 flex items-center gap-4">
                    <x-secondary-button type="submit">{{ __('Enregistrer') }}</x-secondary-button>
                    <x-danger-link href="{{route('events.index')}}">{{ __('Annuler') }}</x-danger-link>
                </div>
            </form>
        </section>
    </div>

    <script>
        const streamers = document.querySelectorAll(".streamer")
        const searchField = document.querySelector("#search");

        function updateList(value) {
            console.log(streamers);
            for (let streamer of streamers) {
                console.log(streamer.id, streamer.id.includes(value));
                streamer.classList.add('hidden');
                if (!value || streamer.id.includes(value)) {
                    streamer.classList.remove('hidden');
                }
            }
        }
    </script>
</x-app-layout>
