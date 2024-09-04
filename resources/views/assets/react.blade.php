<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>React</title>

    <!-- Scripts -->
    <script src="/storage/assets/tmi.min.js"></script>
    @vite(['resources/css/app.css', 'resources/css/assets.css', 'resources/css/chatbox.css', 'resources/js/app.js'])
</head>
<body class="bg-cover h-[1080px] w-[1920px]">
@if($chatbox)
    <main class="absolute top-8 right-8 h-[588px] w-[400px] overflow-hidden">
        <div id="main-container"
             class="h-full w-full px-4 font-bold shadow-xl backdrop-blur-3xl backdrop-brightness-200 bg-black/55">
            <div id="no-channel"
                 class="hidden h-screen w-screen content-center text-center text-3xl text-primary"></div>
            <template id="message-template">
                <article class="chat-container">
                    <h1 class="username-container"></h1>
                    <p class="message-container"></p>
                </article>
            </template>
        </div>
    </main>
@endif

</body>

<script>
    const channel = "{{ $_REQUEST['channel'] ?? null }}";
    const template = document.querySelector('#message-template');

    if (!channel) {
        document.querySelector('#no-channel').innerHTML = `<p>Aucune chaîne sélectionnée.</p>`;
        document.querySelector('#no-channel').classList.remove('hidden');
        document.querySelector('#no-channel').classList.add('grid');
    }

    const colors = ["#FF0000", "#0000FF", "#00FF00", "#B22222", "#FF7F50", "#9ACD32", "#FF4500", "#2E8B57", "#DAA520", "#D2691E", "#5F9EA0", "#1E90FF", "#FF69B4", "#8A2BE2", "#00FF7F"];
    const badges = {
        vip: 'b817aba4-fad8-49e2-b88a-7cc744dfa6ec',
        "glhf-pledge": '3158e758-3cb4-43c5-94b3-7639810451c5',
        moderator: '3267646d-33f0-4b17-b3df-f923a41db1d0',
        broadcaster: '5527c58c-fb7d-422d-b71b-f309dcb85cc1',
        partner: 'd12a2e27-16f6-41d0-ab77-b780518f00a3'
    }
    const client = new tmi.Client({
        channels: [channel]
    });

    client.connect().catch(console.error);

    client.on('message', (channel, tags, message, self) => {
        const emotes = new Map();
        let formattedMessage = message;
        let username = `<span class="username">${tags['display-name']}</span>`;
        if (tags.emotes) {
            for (const [key, value] of Object.entries(tags.emotes)) {
                for (const index of value) {
                    const indexes = index.split("-");
                    const img = `<span class="emote"><img src="https://static-cdn.jtvnw.net/emoticons/v2/${key}/default/dark/1.0" alt="emote"></span>`;
                    const id = `<${randomString(parseInt(indexes[1]) - parseInt(indexes[0]) - 1)}>`;
                    emotes.set(id, img);
                    const arr = formattedMessage.split('');
                    arr.splice(parseInt(indexes[0]), parseInt(indexes[1]) - parseInt(indexes[0]) + 1, id);
                    formattedMessage = arr.join('');
                }
            }

            emotes.forEach((values, keys) => {
                formattedMessage = formattedMessage.replace(keys, values);
            });
        }
        if (tags.badges) {
            for (const [key, value] of Object.entries(tags.badges)) {
                if (badges[key]) {
                    username = `<img src="https://static-cdn.jtvnw.net/badges/v1/${badges[key]}/1" alt="badge" class="badge">` + username;
                }
            }
        }

        let color = tags['color'] ? tags['color'] : colors[getRandomInt(colors.length)];

        const clone = document.importNode(template.content, true);
        clone.querySelector('.username-container').innerHTML = username;
        clone.querySelector('.username-container').style.color = color;
        clone.querySelector('.message-container').innerHTML = formattedMessage;
        document.querySelector('#main-container').appendChild(clone);
        window.scroll(0, document.querySelector('#main-container').offsetHeight + 10);
    });

    const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    function randomString(length) {
        let result = '';
        for (let i = 0; i < length; ++i) {
            result += alphabet[Math.floor(alphabet.length * Math.random())];
        }
        return result;
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }
</script>
</html>
