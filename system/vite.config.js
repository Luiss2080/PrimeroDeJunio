import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [], // CSS ahora se sirve directamente desde public/css
            refresh: true,
        }),
        tailwindcss(),
    ],
});
