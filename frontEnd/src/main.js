import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap"

export const link = 'http://192.168.1.33:8003';


const app = createApp(App);

app.use(router)

app.mount('#app')
