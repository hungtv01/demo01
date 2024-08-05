import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/cms/main.css', 
                'resources/cms/src/css/app.css',
                'resources/cms/src/js/app.js',
                'resources/cms/main.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
          // Alias 'vue' to use the full build (runtime + compiler)
          vue: 'vue/dist/vue.esm-bundler.js'
        }
      }
});
