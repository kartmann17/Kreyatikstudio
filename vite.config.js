import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['axios'],
                },
            },
        },
    },
    server: {
        hmr: {
            host: 'kreyatiklaravel.test',
            port: 5173,
        },
        host: 'kreyatiklaravel.test',
        port: 5173,
        https: true,
    },
});
