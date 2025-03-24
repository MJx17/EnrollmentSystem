import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                // Add any additional JS or CSS files that need to be processed
                'node_modules/admin-lte/dist/css/adminlte.min.css', // Example for AdminLTE CSS
                'node_modules/admin-lte/dist/js/adminlte.min.js', // Example for AdminLTE JS
            ],
        }),
    ],
    build: {
        outDir: 'public/build', // Output directory for production build
        manifest: true, // Generates manifest.json to link compiled assets
    }
});