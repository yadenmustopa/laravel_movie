import { defineConfig } from 'vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import {createHtmlPlugin} from 'vite-plugin-html';
import path from 'path';

const SRC_DIR = path.resolve('.', './src');
const PUBLIC_DIR = path.resolve('.', './public');
const BUILD_DIR = path.resolve('.', './public');


// https://vitejs.dev/config/
export default defineConfig({
  plugins: [svelte(),createHtmlPlugin({
            minify: false,
            inject: {
                data: {
                    TARGET: process.env.TARGET,
                },
            },
        }),
    ],
    root: SRC_DIR,
    base: '',
    publicDir: PUBLIC_DIR,
    build: {
        outDir: BUILD_DIR,
        assetsInlineLimit: 0,
        emptyOutDir: true,
        rollupOptions: {
            treeshake: false,
        },
    },
    resolve: {
        alias: {
            '@': SRC_DIR,
        },
    },
    server: {
        host: true,
    },

})
