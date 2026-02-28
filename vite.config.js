import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'node:path';
import VueI18nPlugin from '@intlify/unplugin-vue-i18n/vite'
import mkcert from 'vite-plugin-mkcert'

export default defineConfig({
    server: {
        origin: 'https://localhost:5173',
    },
    optimizeDeps: {
        include: [
          'tailwind.config.js',
        ]
    },
    build: {
        commonjsOptions: {
          include: ['tailwind.config.js', 'node_modules/**'],
        },
    },
    resolve: {
        alias: {
            'tailwind.config.js': path.resolve(__dirname, 'tailwind.config.js'),
            '@images': path.resolve(__dirname, 'resources/images'),
            '@icons': path.resolve(__dirname, 'resources/icons'),
        },
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        mkcert(),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        VueI18nPlugin({
            include: [path.resolve(__dirname, './lang/**')],
            strictMessage: true,
            escapeHtml: true,
            runtimeOnly: true,
            compositionOnly: true,
            fullInstall: true,
            // forceStringify: true
        })
    ],
});
