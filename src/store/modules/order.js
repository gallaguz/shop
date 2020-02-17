import Axios from "axios";

export default {
    state: {
        orders: [],
        order: []
    },
    actions: {
        getApiOrders ({ commit }) {
            Axios.post(
                '/api/order/',
                {
                    action: 'getAll'
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('setOrders', response.data.orders);
                }
            });
        },
        getApiOrder ({ commit, state }, id) {
            Axios.post(
                '/api/order/',
                {
                    action: 'get',
                    id: id
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('setOrder', response.data.order);
                }
            });
        }
    },
    mutations: {
        setOrders (state, orders) {
            state.orders = orders;
        },
        setOrder (state, order) {
            state.order.push(order);
        }
    },
    getters: {
        ORDERS: state => {
            return state.orders;
        },
        ORDER: (state) => (id) => {
            return state.order.find(order => +order.id === +id);
        },
        ORDERTOTAL: (state) => (id) => {
            let order = state.order.find(order => +order.id === +id);
            return order.cart.reduce(
                (acc, item) => acc + parseInt(item.count) * parseInt(item.price), 0
            );
        }
    }
}
