<x-app-layout>
    <x-slot name="header">
        <p>
            {{ __('Programme') }}
        </p>
    </x-slot>


    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <section class="p-6 text-gray-900 w-full">
            <header class="mb-8">
                <h2 class="text-xl font-medium text-gray-900">
                    Créer un nouvel événement
                </h2>
            </header>
            <form action="{{ route('event.store') }}" method="post">
                @csrf
                <fieldset class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="col-span-2">
                        <x-input-label for="title" :value="__('Titre')"/>
                        <x-text-input id="title" name="title" type="text" class="mt-1 w-full"
                                      :value="old('title')" required autofocus
                                      autocomplete="none"/>
                        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                    </div>

                    <div>
                        <x-input-label for="date" :value="__('Date')"/>
                        <input type="datetime-local" name="date" id="date"
                               value="2024-10-05T19:00"
                               min="2024-10-04T15:00"
                               max="2024-10-06T23:59"
                               class="mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <x-input-error class="mt-2" :messages="$errors->get('date')"/>
                    </div>

                    <div x-data="{show: false}">
                        <x-input-label>Participant·es</x-input-label>
                        <button @click.prevent="show = true"
                                class="block mt-1 py-1 px-3 bg-slate-200 border-slate-500 rounded-md">Ajouter
                        </button>
                        <div class="absolute top-0 left-0 grid bg-slate-900/80 w-full h-screen" x-show="show">
                            <fieldset class="p-6 w-1/5 m-auto bg-white rounded-md shadow-sm"
                                      @click.outside="show = false">
                                <p class="block text-base font-semibold leading-6 text-gray-900">
                                    Participant·es</p>
                                <div
                                    class="mt-8 divide-y divide-gray-200 border-b border-t border-gray-200 h-96 overflow-y-auto">
                                    @foreach($streamers as $streamer)
                                        <div class="relative flex items-start py-4">
                                            <div class="relative mx-3 flex items-center">
                                                <div class="relative w-8 h-8 top-0 left-0"
                                                     x-data="{selected: false}">
                                                    <input id="{{ $streamer['login'] }}"
                                                           @click="selected = !selected"
                                                           name="streamers[{{$loop->iteration}}]"
                                                           type="checkbox"
                                                           value="{{ $streamer->id }}"
                                                           class="z-20 absolute top-0 h-8 w-8 rounded-full border-gray-300 text-indigo-600/25 bg-white/0 opacity-50">
                                                    <img src="{{ $streamer['profile_image_url'] }}"
                                                         alt="Profile picture"
                                                         class="z-10 absolute top-0 h-8 w-8 rounded-full relative"
                                                         :class="selected ? 'opacity-100' : 'opacity-25'">
                                                </div>
                                            </div>
                                            <div class="min-w-0 flex-1 text-sm leading-6">
                                                <label for="person-1"
                                                       class="select-none font-medium text-gray-900">
                                                    {{ $streamer['display_name'] }}
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
                <div class="mt-8">
                    <x-input-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description"
                              class="mt-1 resize-none w-full h-28 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    >{{old('description')}}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                </div>

                <div class="flex items-center gap-4 mt-8">
                    <x-secondary-button type="submit">{{ __('Ajouter') }}</x-secondary-button>
                    <x-danger-link href="{{route('events.index')}}">{{ __('Annuler') }}</x-danger-link>
                </div>
            </form>
        </section>
    </div>
</x-app-layout>
