import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import "bootstrap"

export const link = 'http://192.168.0.108:8003';
export const kindergartenLink = 'http://menu.kindergarten.sfera.local/'


const app = createApp(App);

app.use(router)

app.mount('#app')
