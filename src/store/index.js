import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex);

import cart from "./modules/cart";
import catalog from "./modules/catalog";
import user from "./modules/user";
import order from "./modules/order";

export default new Vuex.Store({
    modules: {
        cart,
        catalog,
        user,
        order
    },
    mutations: {

    }
});
