import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// export default defineConfig({ plugins: [tailwindcss()] });

export default defineConfig({
    plugins: [
        laravel(['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/admin/theme.css']),
    ],
});
