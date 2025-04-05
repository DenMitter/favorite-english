import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import App from "./components/App.vue";

import '../css/app.css';
import '../css/admin.css';

createApp(App).use(router).mount('#app');
