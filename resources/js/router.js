import { createRouter, createWebHistory } from 'vue-router';

import Index from './components/pages/Index.vue';
import Home from './components/pages/dashboard/Home.vue';
import AdminHome from './components/pages/admin/Home.vue';
import NotFound from './components/pages/NotFound.vue';

const routes = [
    {
        path: '/',
        component: Index,
        name: 'Index',
    },
    {
        path: '/dashboard/home',
        component: Home,
        name: 'Home',
        meta: { requiresAuth: true },
    },
    {
        path: '/admin',
        component: AdminHome,
        name: 'AdminHome',
        meta: { requiresAuth: true, requiresAdmin: true },
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        name: 'NotFound',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from) => {
    const authenticated = localStorage.getItem('authenticated');

    if (to.meta.requiresGuest && authenticated) {
        return {
            name: 'Home',
        };
    } else if (to.meta.requiresAuth && !authenticated) {
        return {
            name: 'Index',
        };
    }

    if (to.meta.requiresAdmin && authenticated) {
        const isAdmin = await checkAdminStatus();
        if (!isAdmin) {
            return {
                name: 'Home',
            };
        }
    }
});

const checkAdminStatus = async () => {
    try {
        const token = localStorage.getItem('token');
        const response = await axios.post('/api/admin', {}, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        return response.data.success;
    } catch (error) {
        return false;
    }
};

export default router;
