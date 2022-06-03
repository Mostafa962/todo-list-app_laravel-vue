require('./bootstrap');

import { createApp } from 'vue'
import app from './components/app.vue';

createApp({
    components: { app }
}).mount('#app')