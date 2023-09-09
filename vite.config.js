import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
     server : {
        hmr:{
            host: process.env.DDEV_HOSTNAME,
            protocol : 'wss',
            refresh: false
        },
        refresh: false
    },
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            // refresh: ['resources/**']
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        extensions: ['.vue', '.js', '.ts', '.tsx', '.jsx'],
    }
});
