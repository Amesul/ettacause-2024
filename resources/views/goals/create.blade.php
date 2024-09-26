<x-guest-layout>
    <form action="{{ route('streamers.goals.generate') }}" method="post">
        @csrf @method('PUT')
        <div class="mt-2">
            Coller ici le lien de vos jalons, récupéré sur Streamlabs Charity.
        </div>
        <div class="mt-4">
            <x-input-label for="charity-milestones" :value="__('Lien')"/>
            <x-text-input id="charity-milestones" class="block mt-1 w-full" type="url" name="charity-milestones"
                          required autocomplete="off"/>
            <x-input-error :messages="$errors->get('charity-milestones')" class="mt-2"/>
        </div>

        <div class="flex items-baseline justify-end mt-4 gap-4">
            <a href="{{ route('goals.show') }}" class="text-sm font-bold underline text-gray-600">Je n'ai pas de DG.</a>
            <x-secondary-button type="submit" class="ml-4">
                {{ __('Générer') }}
            </x-secondary-button>
        </div>
    </form>
</x-guest-layout>
