<template>
    <div>
        Корзина:
        <hr>
        <CartItem
                v-for="item in getStoreCart"
                :key="item.id"
                :title="item.title"
                :id="item.id"
                :count="item.count"
                :price="item.price"
                @changed="handleQuantityChange"
                @deleted="handleDelete"
        />
        <hr>
        Всего: {{ total }} денег
    </div>
</template>

<script>
    import store from '../../store/index.js';

    import CartItem from "../elements/CartItem.vue";

    export default {
        name: "CartPage",
        components: {
            CartItem
        },
        methods: {
            getApiCart() {
                store.dispatch('getApiCart');
            },
            handleQuantityChange(item) {
                store.dispatch('handleCartChange', item);
            },
            handleDelete(id) {
                store.dispatch('handleDeleteClick', id);
            }
        },
        computed: {
            getStoreCart () {
                return store.getters.getCart;
            },
            total() {
                return store.getters.getCartTotal;
            },
            count() {
                return store.getters.getCartCount;
            }
        },
        created() {
            this.getApiCart();
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>