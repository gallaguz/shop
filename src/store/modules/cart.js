export default {
    state: {
        cart: []
    },
    actions: {
        getApiCart({commit}) {
            fetch('/api/cart/', {
                method: 'POST',
                body: JSON.stringify({
                    action: 'get'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    this.cart = res.cart;

                    commit('setCart', res.cart);
                });
        },
        handleBuyClick({state, commit}, item) {
            const cartItem = state.cart.find((cartItem) => +cartItem.id === +item.id);
            fetch(`/api/cart/`, {
                method: 'POST',
                body: JSON.stringify(
                    {
                        action: 'add',
                        id: item.id
                    }
                ),
                headers: {
                    'Content-type': 'application/json',
                }
            }).then(res => res.json())
                .then(res => {
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
                fetch(`/api/cart/`, {
                    method: 'POST',
                    body: JSON.stringify(
                        {
                            action: 'update',
                            id: id,
                            count: cartItem.count - 1
                        }
                    ),
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(res => res.json())
                    .then(res => {
                        cartItem.count--;
                    });
            } else {
                fetch(`/api/cart/`, {
                    method: 'POST',
                    body: JSON.stringify(
                        {
                            action: 'delete',
                            id: id
                        }
                    ),
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        commit('deleteProductFromCart', id);
                    });
            }
        },
        handleCartChange({state, commit}, item) {
            const cartItem = state.cart.find((cartItem) => +cartItem.id === +item.id);

            cartItem.count = item.count;

            if (cartItem && item.count < 1) {
                commit('deleteProductFromCart', item.id);
            } else {
                fetch(`/api/cart/`, {
                    method: 'POST',
                    body: JSON.stringify(
                        {
                            action: 'update',
                            id: item.id,
                            count: item.count
                        }
                    ),
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                    });
            }
        },
    },
    mutations: {
        setCart(state, cart) {
            state.cart = cart;
        },
        pushProductToCart(state, {item}) {
            state.cart.push({...item, count: 1});
        },
        deleteProductFromCart(state, id) {
            state.cart = state.cart.filter((item) => item.id !== id);
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
