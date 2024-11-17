import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import Index from "./components/Index.vue";
import Registration from "./components/Auth/Registration.vue";

const app = createApp({});

app.component('index', Index);
app.component('registration', Registration);
app.use(router);
app.mount('#app');
