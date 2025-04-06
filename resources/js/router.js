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
        meta: {
            title: 'Головна сторінка — Favorite English',
            description: 'Навчайтеся англійської мови з найкращими викладачами онлайн.',
            keywords: 'англійська, онлайн школа, англійська мова',
        },
    },
    {
        path: '/dashboard/home',
        component: Home,
        name: 'Home',
        meta: {
            title: 'Особистий кабінет — Favorite English',
            requiresAuth: true
        },
    },
    {
        path: '/admin',
        component: AdminHome,
        name: 'AdminHome',
        meta: {
            title: 'Адмін панель — Favorite English',
            requiresAuth: true,
            requiresAdmin: true,
        },
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        name: 'NotFound',
        meta: {
            title: 'Сторінка не знайдена — Favorite English',
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach(async (to, from) => {
    if (to.meta.title) {
        document.title = to.meta.title;
    }

    if (to.meta.description) {
        let metaDescription = document.querySelector('meta[name="description"]');
        if (!metaDescription) {
            metaDescription = document.createElement('meta');
            metaDescription.setAttribute('name', 'description');
            document.head.appendChild(metaDescription);
        }
        metaDescription.setAttribute('content', to.meta.description);
    }

    if (to.meta.keywords) {
        let metaKeywords = document.querySelector('meta[name="keywords"]');
        if (!metaKeywords) {
            metaKeywords = document.createElement('meta');
            metaKeywords.setAttribute('name', 'keywords');
            document.head.appendChild(metaKeywords);
        }
        metaKeywords.setAttribute('content', to.meta.keywords);
    }

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
