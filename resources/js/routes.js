import {createWebHistory, createRouter} from "vue-router";

import Home from './components/Pages/Home';
import Register from './components/Pages/Register';
import Login from './components/Pages/Login';
import Dashboard from './components/Pages/Dashboard';
import NotFound from './components/Pages/NotFound';
import Cards from './components/Pages/Cards'
import Games from './components/Pages/Games'
import Groups from './components/Pages/Groups'
import Baskets from './components/Pages/Baskets'
import BasketDetail from './components/Pages/BasketDetail'
import Order from './components/Pages/Order'
import Products from './components/Pages/Products'
import Print from './components/Pages/Print'
import axios from "axios";

const routes = [
    {
        path: '/',
        component: Home,
        name: "Home",
        meta: {requiresAuth: false}
    },
    {
        path: '/print/:basket',
        name: "Print",
        component: Print,
        props: true,
        meta: {requiresAuth: true}
    },
    {
        path: '/register',
        component: Register,
        name: "Register",
        meta: {requiresAuth: false}
    },
    {
        path: '/login',
        component: Login,
        name: 'Login',
        meta: {requiresAuth: false}
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: {requiresAuth: true}
    },
    {
        path: "/cards",
        name: "Cards",
        component: Cards,
        meta: {requiresAuth: true}
    },
    {
        path: "/games",
        name: "Games",
        component: Games,
        meta: {requiresAuth: true}
    },
    {
        path: "/groups",
        name: "Groups",
        component: Groups,
        meta: {requiresAuth: true}
    },
    {
        path: "/products",
        name: "Products",
        component: Products,
        meta: {requiresAuth: true}
    },
    {
        path: '/baskets/:date',
        name: "Baskets",
        component: Baskets,
        props: true,
        meta: {requiresAuth: true}
    },
    {
        path: '/basket-detail/:basket',
        name: "BasketDetail",
        component: BasketDetail,
        props: true,
        meta: {requiresAuth: true}
    },
    {
        path: '/order/:basket',
        name: "Order",
        component: Order,
        props: true,
        meta: {requiresAuth: true}
    },
    {
        path: "/:catchAll(.*)",
        name: '404',
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        axios.get('authenticated')
            .then((response) => {
                next();
            }).catch(() => {
            next("/login");
        });
    } else {
        next();
    }
})

export default router;

