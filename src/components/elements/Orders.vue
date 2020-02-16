<template>
    <div>
        <div v-if="getStoreOrders.length">
            <div v-for="item in getStoreOrders">
                Дата заказа: {{ item.date }} /
                Статус: {{ item.status }}
            </div>
        </div>
        <div v-else>
            Пока нет заказов
        </div>
    </div>
</template>

<script>
    import store from '../../store/index.js';

    export default {
        name: "Orders",

        methods: {
            getOrders() {
                store.dispatch('getApiOrders');
            }
        },
        computed: {
            getStoreOrders() {
                return store.getters.getOrders;
            },
        },
        mounted() {
            this.getOrders();
        }
    }
</script>

<style scoped>

</style>