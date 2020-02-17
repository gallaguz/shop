import Axios from "axios";

export default {
    state: {
        orders: []
    },
    actions: {
        updateApiOrders({commit, state}, {
            status: status,
            order_id: order_id
        }) {
            Axios.post(
                '/api/order/',
                {
                    action: 'update',
                    status: status,
                    id: order_id
                }
            ).then((response) => {
                commit('updateOrder', {
                    status: status,
                    order_id: order_id
                });
            });
        },
        getApiOrdersAdmin({commit}) {
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
        updateOrder(state, {
            order_id: order_id,
            status: status
        }) {
            const order = state.orders.find((order) =>
                +order.id === +order_id);
            order.status = status;
        },
        setOrdersAdmin(state, orders) {
            state.orders = orders;
        }
    },
    getters: {
        getOrdersAdmin(state) {
            return state.orders;
        }
    }
}
