import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/mcuuid.js',
                'resources/js/likehandler.js',
                'resources/js/admin.js',
                'resources/images/logo.png'
            ],
            refresh: true,
        }),
    ],
});
