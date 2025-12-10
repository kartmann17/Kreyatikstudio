import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import react from "@vitejs/plugin-react";
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js", "resources/js/app.jsx"],
            ssr: 'resources/js/ssr.jsx',
            refresh: true,
        }),
        react(),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
    build: {
        minify: 'terser',
        terserOptions: {
            compress: {
                drop_console: true,
            },
        },
        rollupOptions: {
            output: {
                manualChunks: (id) => {
                    // Ne pas créer de manualChunks en mode SSR
                    if (process.env.npm_lifecycle_script && process.env.npm_lifecycle_script.includes('--ssr')) {
                        return null;
                    }
                    // En mode client, créer les chunks normalement
                    if (id.includes('node_modules')) {
                        if (id.includes('axios')) return 'vendor';
                        if (id.includes('react')) return 'vendor';
                        if (id.includes('react-dom')) return 'vendor';
                    }
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
