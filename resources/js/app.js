import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import App from "./components/App.vue";

import '../css/app.css';
import '../css/admin.css';

import LoadingButtonDirective from './directives/v-loading-button.js'

const app = createApp(App)

app.directive('loading-button', LoadingButtonDirective)

// createApp(App).use(router).mount('#app');
app.use(router).mount('#app')
