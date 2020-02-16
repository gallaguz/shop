import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

const HomePage      = () => import(/* webpack-chunk-name: "HomePage" */     './components/pages/HomePage.vue');
const CatalogPage   = () => import(/* webpack-chunk-name: "CatalogPage" */  './components/pages/CatalogPage.vue');
const CartPage      = () => import(/* webpack-chunk-name: "CartPage" */     './components/pages/CartPage.vue');
const CardPage      = () => import(/* webpack-chunk-name: "CardPage" */     './components/pages/CardPage.vue');
const OrderPage     = () => import(/* webpack-chunk-name: "OrderPage" */    './components/pages/OrderPage.vue');
const ProfilePage   = () => import(/* webpack-chunk-name: "ProfilePage" */  './components/pages/ProfilePage.vue');

export default new VueRouter({
    routes: [
        {
            name: 'home',
            path: '/',
            component: HomePage,
        },
        {
            name: 'catalog',
            path: '/catalog',
            component: CatalogPage,
            props: true

        },
        {
            name: 'cart',
            path: '/cart',
            component: CartPage,
            props: true
        },
        {
            name: 'card',
            path: '/card/:id',
            component: CardPage,
            props: true
        },
        {
            name: 'order',
            path: '/order',
            component: OrderPage,
            props: true
        },
        {
            name: 'profile',
            path: '/profile',
            component: ProfilePage,
            props: true
        }
    ],
    mode: 'history',
});