<section id="streamers" class="relative" x-data="{switchScreen: false}"
    {{-- x-init="setInterval(() => switchScreen = !switchScreen, 3 * 60 * 1000)" --}}>
    <ul class="grid w-full grid-cols-7 gap-y-2 gap-x-6 mb-6 px-24" x-show="!switchScreen"
        x-transition.opacity.duration.1000ms>
        @foreach($streamers as $streamer)
            @if($streamer->login !== 'ettacause')
                <li>
                    <a href="https://twitch.tv/{{ $streamer->login }}" target="_blank">
                        <figure class="{{ $streamer->online ? '' : 'opacity-50' }} h-28"
                                id="{{ $streamer->id }}">
                            <div class="container relative">
                                <img src="{{ $streamer->profile_image_url }}" alt=""
                                     class=" rounded-full w-12 m-auto {{ $streamer->online ? 'outline' : '' }} outline-2 outline-[#92ffff]/35 z-20 outline-offset-4">

                                <span
                                    class="rounded-full w-12 h-12 absolute top-0 inset-0 m-auto {{ $streamer->online ? 'outline' : '' }} z-10 outline-2 outline-[#92ffff] animate-pulse outline-offset-4"></span>
                            </div>
                            <figcaption class="max-h-12 w-full overflow-hidden">
                                <p class="text-center mt-1 text-stone-100 font-bold">{{ $streamer->display_name }}
                                    <span
                                        class="{{ $streamer->online ? '' : 'hidden' }} bg-[#92ffff] relative z-20 ml-2 w-2 h-2 inline-block rounded-full">
                        <span
                            class="bg-secondary z-10 absolute top-0 left-0 w-2 h-2 animate-ping inline-block rounded-full"></span>
                    </span>
                                </p>
                                <p class="text-center text-primary truncate">
                                    {{ $streamer->title }}
                                </p>
                            </figcaption>
                        </figure>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
    {{--    <ul class="absolute top-0 left-0 grid w-full grid-cols-2 px-24 text-white" x-show="switchScreen"--}}
    {{--        x-transition.opacity.duration.1000ms>--}}
    {{--        @foreach($streamers as $streamer)--}}
    {{--            @if($streamer->slc_access_token)--}}
    {{--                <li class="mx-6 my-2">--}}
    {{--                    <p class="text-start text-xl font-bold text-primary">{{ $streamer->display_name }}</p>--}}
    {{--                    <!--  BAR -->--}}
    {{--                    <div id="bar-container" class="py-2">--}}
    {{--                        <div id='{{ $streamer->login }}-goal-bar'--}}
    {{--                             class="relative h-8 w-full overflow-hidden rounded-full bg-zinc-500 py-px">--}}
    {{--                            <span class='absolute z-10 px-4 text-xl font-medium text-black'--}}
    {{--                                  id='{{ $streamer->login }}-current-amount'>{{ number_format($streamer->current_slc_amount, 2, ',', ' ') }} €</span>--}}
    {{--                            <span--}}
    {{--                                class='absolute z-10 inline-block w-full px-4 text-center align-middle text-xl font-medium text-black'--}}
    {{--                                id='{{ $streamer->login }}'>{{$streamer->next_slc_milestone['milestone']}}</span>--}}
    {{--                            <span class='absolute z-10 w-full px-4 text-end text-xl font-medium text-black'--}}
    {{--                                  id='{{ $streamer->login }}-goal-amount'>{{$streamer->next_slc_milestone['next_slc_goal']}} €</span>--}}
    {{--                            <span id='{{ $streamer->login }}-bar'--}}
    {{--                                  class="absolute top-0 left-0 h-full opacity-0 bg-secondary"></span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </li>--}}
    {{--                <script>--}}
    {{--                    if ({{$streamer->current_slc_amount}} > 0) {--}}
    {{--                        let bar = document.querySelector(`#{{ $streamer->login }}-bar`)--}}
    {{--                        bar.style.opacity = "100";--}}
    {{--                        bar.style.width = Math.min(Math.max({{$streamer->current_slc_amount}} * (100 / {{$streamer->next_slc_milestone['next_slc_goal']}}), 0), 100) + '%';--}}
    {{--                    }--}}
    {{--                </script>--}}
    {{--            @endif--}}
    {{--        @endforeach--}}
    {{--    </ul>--}}
</section>
