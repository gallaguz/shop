import Vue from 'vue';
import VueRouter from 'vue-router';
import AdminPage from "./components/pages/AdminPage";


Vue.use(VueRouter);

const HomePage      = () => import(/* webpack-chunk-name: "HomePage" */     './components/pages/HomePage.vue');
const CatalogPage   = () => import(/* webpack-chunk-name: "CatalogPage" */  './components/pages/CatalogPage.vue');
const CartPage      = () => import(/* webpack-chunk-name: "CartPage" */     './components/pages/CartPage.vue');
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
            name: 'profile',
            path: '/profile',
            component: ProfilePage,
            props: true
        },
        {
            name: 'admin',
            path: '/admin',
            component: AdminPage,
            props: true
        }
    ],
    mode: 'history',
});