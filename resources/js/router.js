import { createRouter, createWebHistory } from 'vue-router';
import IndexPage from './components/IndexPage.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: IndexPage,
            name: 'index'
        }
    ]
});

export default router;
