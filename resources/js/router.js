import { createRouter, createWebHistory } from 'vue-router';

import Index from '../components/pages/Index.vue';

const routes = [
    {
        path: '/',
        component: Index,
        name: 'Index',
    },
];

const index = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default index;
