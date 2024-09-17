import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/gradient.css',
                'resources/js/gradient.js',
                'resources/css/chatbox.css',
                'resources/js/app.js',
                'resources/images/hero.png',
                'resources/images/div.png'
            ],
            refresh: true,
            publicDirectory: '/public',
        }),
    ],
});
