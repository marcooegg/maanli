// main.js
import { createApp } from 'vue'
import App from './App.vue'

const app = createApp(App)

// Plugin simple para mostrar si estamos online/offline
app.config.globalProperties.$online = navigator.onLine

window.addEventListener('online', () => {
  app.config.globalProperties.$online = true
})
window.addEventListener('offline', () => {
  app.config.globalProperties.$online = false
})

app.mount('#app')
