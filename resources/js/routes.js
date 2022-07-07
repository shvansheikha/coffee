import {createWebHistory, createRouter} from "vue-router";

import Home from './components/Pages/Home';
import About from './components/Pages/About';
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

const routes = [
    {
        path: '/',
        component: Home,
        name: "Home"
    },
    {
        path: '/about',
        component: About,
        name:"About"
    },
    {
        path: '/register',
        component: Register,
        name: "Register"
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        beforeEnter: (to, form, next) => {
            axios.get('authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    {
        path: "/cards",
        name: "Cards",
        component: Cards,
        beforeEnter: (to, form, next) => {
            axios.get('authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    {
        path: "/games",
        name: "Games",
        component: Games,
        beforeEnter: (to, form, next) => {
            axios.get('authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    {
        path: "/groups",
        name: "Groups",
        component: Groups,
        beforeEnter: (to, form, next) => {
            axios.get('authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    {
        path: "/products",
        name: "Products",
        component: Products,
        beforeEnter: (to, form, next) => {
            axios.get('authenticated').then(() => {
                next()
            }).catch(() => {
                return next({name: 'Login'})
            })
        }
    },
    {
        path: '/baskets/:date',
        name: "Baskets",
        component: Baskets,
        props: true
    },
    {
        path: '/basket-detail/:basket',
        name: "BasketDetail",
        component: BasketDetail,
        props: true
    },
    {
        path: '/order/:basket',
        name: "Order",
        component: Order,
        props: true
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

export default router;

