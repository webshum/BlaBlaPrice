import dotenv from 'dotenv';
import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite'
import vue from '@vitejs/plugin-vue';

dotenv.config();

export default defineConfig({
  publicDir: 'resources/static',
  server: {
    cors: true,
    strictPort: true,
  },
  build: {
    assetsDir: '',
    emptyOutDir: true,
    manifest: true,
    outDir: `frontend/web/${process.env.APP_THEME}/assets`,
    rollupOptions: {
      input: 'resources/js/index.js',
    },
  },
  plugins: [
    vue(),
    tailwindcss(),
    {
      name: 'php',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.php')) {
          server.ws.send({ type: 'full-reload', path: '*' });
        }
      },
    },
  ],
});
