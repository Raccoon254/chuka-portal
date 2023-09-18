import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            watch: [
                'resources/views/**',
                'routes/**',
                'resources/routes/**',
            ],
            refresh: [{
                paths: ['\'resources/views/**\', \'routes/**\', \'resources/routes/**\''],
                config: { delay: 300 }
            }],
        }),
    ],
});
