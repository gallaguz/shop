import Axios from "axios";

export default {
    state: {
        cart: []
    },
    actions: {
        addOrder ({commit}, {
            name: name,
            phone: phone
        }) {
            Axios.post(
                '/api/order/',
                {
                    action: 'add',
                    name: name,
                    phone: phone
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('clearCart');
                }
                console.log('Заказ оформлен');
            });
        },
        getApiCart({commit}) {
            Axios.post(
                '/api/cart/',
                {
                    action: 'get'
                }
            ).then((response) => {
                if (response.data.error === false) {
                    commit('setCart', response.data.cart);
                }
            });
        },
        handleBuyClick({state, commit}, item) {
            const cartItem = state.cart.find((cartItem) => +cartItem.id === +item.id);

            Axios.post(
                '/api/cart/',
                {
                    action: 'add',
                    id: item.id
                }
            ).then((response) => {
                if (cartItem) {
                    cartItem.count++;
                } else {
                    commit('pushProductToCart', item);
                }
            });
        },
        handleDeleteClick({state, commit}, id) {
            const cartItem = state.cart.find((cartItem) => +cartItem.id === +id);

            if (cartItem && cartItem.count > 1) {
                Axios.post(
                    '/api/cart/',
                    {
                        action: 'update',
                        id: id,
                        count: cartItem.count - 1
                    }
                ).then((response) => {
                    cartItem.count--;
                });
            } else {
                Axios.post(
                    '/api/cart/',
                    {
                        action: 'delete',
                        id: id
                    }
                ).then((response) => {
                    commit('deleteProductFromCart', id);
                });
            }
        },
        handleCartChange({state, commit}, item) {
            const cartItem = state.cart.find((cartItem) => +cartItem.id === +item.id);

            cartItem.count = item.count;

            if (cartItem && item.count < 1) {
                Axios.post(
                    '/api/cart/',
                    {
                        action: 'delete',
                        id: item.id
                    }
                ).then((response) => {
                    commit('deleteProductFromCart', item.id);
                });
            } else {
                Axios.post(
                    '/api/cart/',
                    {
                        action: 'update',
                        id: item.id,
                        count: item.count
                    }
                ).then((response) => {

                });
            }
        }
    },
    mutations: {
        clearCart(state) {
            state.cart = [];
        },
        setCart(state, cart) {
            state.cart = cart;
        },
        pushProductToCart(state, {item}) {
            state.cart.push({...item, count: 1});
        },
        deleteProductFromCart(state, id) {
            state.cart = state.cart.filter((item) => +item.id !== +id);
        },
    },
    getters: {

        getCart(state) {
            return state.cart
        },
        getCartCount(state) {
            return state.cart.reduce(
                (acc, item) => acc + parseInt(item.count), 0
            );
        },
        getCartTotal(state) {
            return state.cart.reduce(
                (acc, item) => acc + parseInt(item.count) * parseInt(item.price), 0
            );
        }
    }
}
