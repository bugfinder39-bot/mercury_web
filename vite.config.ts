import inertia from '@inertiajs/vite';
import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import { defineConfig } from 'vite';

export default defineConfig(({ command }) => {
    // Wayfinder requires PHP to generate routes, so we only run it during 'serve' (local dev)
    const isDev = command === 'serve';

    return {
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.ts'],
                refresh: true,
                fonts: [
                    bunny('Instrument Sans', {
                        weights: [400, 500, 600],
                    }),
                ],
            }),
            inertia(),
            tailwindcss(),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            // Enable Wayfinder ONLY during local development (`npm run dev`)
            isDev && wayfinder({
                formVariants: true,
            }),
        ].filter(Boolean),

        build: {
            chunkSizeWarningLimit: 1500, // Raised to 1500 kB
            rollupOptions: {
                onwarn(warning, defaultHandler) {
                    // Suppress INVALID_ANNOTATION warnings coming from node_modules
                    if (warning.code === 'INVALID_ANNOTATION') return;
                    defaultHandler(warning);
                },
                output: {
                    manualChunks(id) {
                        // Split npm packages into smaller chunks instead of one giant vendor file
                        if (id.includes('node_modules')) {
                            if (id.includes('@inertiajs')) {
                                return 'vendor-inertia';
                            }
                            if (id.includes('vue') || id.includes('@vue')) {
                                return 'vendor-vue';
                            }
                            if (id.includes('reka-ui') || id.includes('@vueuse')) {
                                return 'vendor-ui';
                            }
                            return 'vendor'; // All other packages
                        }
                    },
                },
            },
        },
    };
});