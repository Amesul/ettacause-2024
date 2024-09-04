@props(['title', 'category'])

<div {{ $attributes->merge(['class'=>'bg-white overflow-hidden shadow-sm sm:rounded-lg']) }}>
    <div class="w-full p-4 text-gray-900">
        <form action="{{ route('queer-quiz.store') }}" method="post">
            @csrf
            <h2 class="text-2xl font-staatliches">{{ $title }}</h2>
            <div class="mt-2">
                <x-input-label for="amount" :value="__('Montant')"/>
                <div class="flex gap-4">
                    <input type="hidden" name="category" value="{{$category}}">
                    <x-text-input type="number" step="0.01" name="amount" id="{{$category}}_amount" class="flex-1"
                                  required/>
                    <x-secondary-button
                        type="submit">
                        Ajouter
                    </x-secondary-button>
                </div>
                <x-input-error :messages="$errors->get('amount')"/>
            </div>
        </form>
    </div>
</div>
