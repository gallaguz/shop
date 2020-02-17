<template>
    <div>
        <div v-if="getStoreOrders.length">
            <div v-for="item in getStoreOrders">
                <OrderItem :item="item" />
            </div>
        </div>
        <div v-else>
            Пока нет заказов
        </div>
    </div>
</template>

<script>
    import OrderItem from "./OrderItem";

    export default {
        name: "Orders",
        components: {
            OrderItem
        },
        methods: {
            getOrders() {
                this.$store.dispatch('getApiOrders');
            }
        },
        computed: {
            getStoreOrders() {
                return this.$store.getters.ORDERS;
            },
        },
        mounted() {
            this.getOrders();
        }
    }
</script>

<style scoped>

</style>