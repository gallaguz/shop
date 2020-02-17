export default {
    state: {
        orders: []
    },
    actions: {
        getApiOrdersAdmin ({ commit }) {
            fetch('/api/order/', {
                method: 'POST',
                body: JSON.stringify({
                    admin: true,
                    action: 'getAll'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    commit('setOrdersAdmin', res.orders);
                });
        },

    },
    mutations: {
        setOrdersAdmin (state, orders) {
            state.orders = orders;
        }
    },
    getters: {
        getOrdersAdmin(state) {
            return state.orders;
        }
    }
}
