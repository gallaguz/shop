<template>
    <div>
        Корзина:
        <hr>
        <CartItem
                v-for="item in getStoreCart"
                :key="item.id"
                :item="item"
                @changed="handleQuantityChange"
                @deleted="handleDelete"
        />
        <hr>
        Всего: {{ total }} денег
        <hr>
        <AddOrder />
    </div>
</template>

<script>
    import CartItem from "../elements/CartItem.vue";
    import AddOrder from "../elements/AddOrder";

    export default {
        name: "CartPage",
        components: {
            CartItem,
            AddOrder
        },
        methods: {
            getApiCart() {
                this.$store.dispatch('getApiCart');
            },
            handleQuantityChange(item) {
                this.$store.dispatch('handleCartChange', item);
            },
            handleDelete(id) {
                this.$store.dispatch('handleDeleteClick', id);
            }
        },
        computed: {
            getStoreCart () {
                return this.$store.getters.getCart;
            },
            total() {
                return this.$store.getters.getCartTotal;
            },
            count() {
                return this.$store.getters.getCartCount;
            }
        },
        created() {
            this.getApiCart();
        },
        mounted() {
            this.$store.dispatch('clearQuery');
        }
    }
</script>

<style scoped>

</style>