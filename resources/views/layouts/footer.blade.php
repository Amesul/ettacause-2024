@php use Illuminate\Support\Facades\Vite; @endphp
<footer class="sticky top-[100vh]">
    <div class="flex w-full items-center h-8 bg-repeat-x bg-stone-100 rotate-180"
         style="background-image: url('{{ Vite::asset('resources/images/div.png') }}');"></div>
    <nav class="bg-slate-950 font-dosis text-slate-300 text-xl px-4 py-6">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 sm:block hidden">
            <div class="grid grid-cols-3 ">
                <article class="mx-auto w-fit">
                    <a class="block hover:text-secondary px-px" href="{{ route('profile.edit') }}">Profil</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('streamers.index') }}">Participant·es</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('events.index') }}">Programme</a>
                </article>

                <article class="mx-auto w-fit">
                    <a class="block hover:text-secondary px-px" href="{{ route('assets.chatbox') }}">Chatbox</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('assets.display') }}">Host panel</a>
                </article>
            </div>
        </div>
        <div class="sm:hidden" id="mobile-menu">
            <div class="mx-auto w-fit">
                <article class="mb-4 w-fit">
                    <a class="block hover:text-secondary px-px" href="{{ route('profile.edit') }}">Profil</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('streamers.index') }}">Participant·es</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('events.index') }}">Programme</a>
                </article>

                <article class="w-fit">
                    <a class="block hover:text-secondary px-px" href="{{ route('assets.chatbox') }}">Chatbox</a>
                    <a class="block hover:text-secondary px-px" href="{{ route('assets.display') }}">Host panel</a>
                </article>
            </div>
        </div>
    </nav>
</footer>
