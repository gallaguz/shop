<template>
    <div>
        Корзина:

        <hr>
        <div v-for="item in this.$parent.cart">
            {{ item.title }}:
            <input class="count" type="number" :value="item.count" v-on:change="handleCartChange" />
            <button @click="handleDeleteClick">x</button> {{ item.price }} x {{ item.count }} = {{ item.price *
            item.count }}
        </div>
        <hr>
        Всего: <b>{{ this.total }}</b> Денег
    </div>
</template>

<script>
    export default {
        name: "TestPage",
        data: function() {
            return {
                count: 0
            }
        },
        methods: {
            // Изменение количества и удаление
            handleDeleteClick() {
                //const cartItem = this.$parent.cart.find((cartItem) => +cartItem.id === +id);

                console.log(this.count);

                //
                // if (cartItem && cartItem.count > 1) {
                //     fetch(`/api/cart/`, {
                //         method: 'POST',
                //         body: JSON.stringify(
                //             {
                //                 action: 'update',
                //                 id: id,
                //                 count: cartItem.count - 1
                //             }
                //         ),
                //         headers: {
                //             'Content-type': 'application/json',
                //         }
                //     }).then(res => res.json())
                //         .then(res => {
                //             cartItem.count--;
                //         });
                // } else {
                //     if (confirm('Вы действительно хотите удалить последний товар?')) {
                //         fetch(`/api/cart/`, {
                //             method: 'POST',
                //             body: JSON.stringify(
                //                 {
                //                     action: 'delete',
                //                     id: id
                //                 }
                //             ),
                //             headers: {
                //                 'Content-type': 'application/json',
                //             }
                //         })
                //             .then(res => res.json())
                //             .then(res => {
                //                 this.$parent.cart = this.$parent.cart.filter((item) => item.id !== id);
                //             });
                //     }
                // }
            },

            // Изменение количества товара
            handleCartChange(item) {
                const cartItem = this.cart.$parent.find((cartItem) => +cartItem.id === +item.id);
                cartItem.count = item.count;

                if (cartItem && item.count < 1) {
                    if (confirm('Вы действительно хотите удалить последний товар?')) {
                        this.$parent.cart = this.$parent.cart.filter((itemInCart) => itemInCart.id !== item.id);
                        fetch(`/cart/delete/`, {
                            method: 'POST',
                            body: JSON.stringify(
                                {
                                    api: 'api',
                                    id: item.id
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
                } else {
                    fetch(`/cart/update/`, {
                        method: 'POST',
                        body: JSON.stringify(
                            {
                                api: 'api',
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
        computed: {
            total() {
                return this.$parent.cart.reduce((acc, item) => acc + parseInt(item.count) * parseInt(item.price), 0);
            }
        }
    }
</script>

<style scoped>

</style><template>
    <div>
        Корзина:
        <hr>
        <div v-for="item in this.$parent.cart">
            {{ item.title }}:
            <input class="count" type="number" :value="item.count" v-on:change="handleCartChange" />
            <button @click="handleDeleteClick">x</button> {{ item.price }} x {{ item.count }} = {{ item.price *
            item.count }}
        </div>
        <hr>
        Всего: <b>{{ this.total }}</b> Денег
    </div>
</template>

<script>
    export default {
        name: "CartPage",
        data: function() {
            return {
                count: 0
            }
        },
        methods: {
            // Изменение количества и удаление
            handleDeleteClick() {
                //const cartItem = this.$parent.cart.find((cartItem) => +cartItem.id === +id);

                console.log(this.count);

                //
                // if (cartItem && cartItem.count > 1) {
                //     fetch(`/api/cart/`, {
                //         method: 'POST',
                //         body: JSON.stringify(
                //             {
                //                 action: 'update',
                //                 id: id,
                //                 count: cartItem.count - 1
                //             }
                //         ),
                //         headers: {
                //             'Content-type': 'application/json',
                //         }
                //     }).then(res => res.json())
                //         .then(res => {
                //             cartItem.count--;
                //         });
                // } else {
                //     if (confirm('Вы действительно хотите удалить последний товар?')) {
                //         fetch(`/api/cart/`, {
                //             method: 'POST',
                //             body: JSON.stringify(
                //                 {
                //                     action: 'delete',
                //                     id: id
                //                 }
                //             ),
                //             headers: {
                //                 'Content-type': 'application/json',
                //             }
                //         })
                //             .then(res => res.json())
                //             .then(res => {
                //                 this.$parent.cart = this.$parent.cart.filter((item) => item.id !== id);
                //             });
                //     }
                // }
            },

            // Изменение количества товара
            handleCartChange(item) {
                const cartItem = this.cart.$parent.find((cartItem) => +cartItem.id === +item.id);
                cartItem.count = item.count;

                if (cartItem && item.count < 1) {
                    if (confirm('Вы действительно хотите удалить последний товар?')) {
                        this.$parent.cart = this.$parent.cart.filter((itemInCart) => itemInCart.id !== item.id);
                        fetch(`/cart/delete/`, {
                            method: 'POST',
                            body: JSON.stringify(
                                {
                                    api: 'api',
                                    id: item.id
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
                } else {
                    fetch(`/cart/update/`, {
                        method: 'POST',
                        body: JSON.stringify(
                            {
                                api: 'api',
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
        computed: {
            total() {
                return this.$parent.cart.reduce((acc, item) => acc + parseInt(item.count) * parseInt(item.price), 0);
            }
        }
    }
</script>

<style scoped>

</style>