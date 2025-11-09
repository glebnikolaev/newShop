import { createRouter, createWebHistory } from 'vue-router'
import Home from './views/Home'
import Register from './views/Register'
import Login from './views/Login'
import Catalog from './views/Catalog'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/catalog',
        name: 'catalog',
        component: Catalog
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }

        return { left: 0, top: 0 };
    },
});

export default router;
