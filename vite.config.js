import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import inject from '@rollup/plugin-inject';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/filepond.js',
                'resources/js/sortable.js',
                'resources/js/tomselect.js',
                'resources/js/easyeditor.js'
            ],
            refresh: true,
        }),
        inject({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        tailwindcss(),
    ],
});
