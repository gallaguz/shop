export default {
    state: {
        orders: []
    },
    actions: {
        getApiOrders ({ commit }) {
            fetch('/api/order/', {
                method: 'POST',
                body: JSON.stringify({
                    action: 'getAll'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    commit('setOrders', res.orders);
                });
        }
    },
    mutations: {
        setOrders (state, orders) {
            state.orders = orders;
        }
    },
    getters: {
        getOrders(state) {
            return state.orders
        }
    }
}
