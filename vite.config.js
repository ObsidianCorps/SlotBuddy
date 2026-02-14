import { defineConfig } from 'vite'
import { resolve } from 'path'

export default defineConfig({
  build: {
    outDir: 'assets/build',
    manifest: true,
    rollupOptions: {
      input: {
        backend: resolve(__dirname, 'src/backend.js'),
        booking: resolve(__dirname, 'src/booking.js'),
        account: resolve(__dirname, 'src/account.js'),
        message: resolve(__dirname, 'src/message.js'),
      },
    },
  },
  server: {
    origin: 'http://localhost:5173',
  },
})
