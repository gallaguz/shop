<template>
    <div>
        <hr>
        <div v-if="getStoreOrder">
            Список товаров:
            <ul>
                <li v-for="item in getStoreOrder.cart">
                    <h4>{{ item.title }}</h4>
                    Цена: {{ item.price }}<br>
                    Количество: {{ item.count }}<br>
                    Всего: {{ item.count * item.price }}
                </li>
            </ul>
            Сумма заказа: {{ getStoreOrderTotal }}
            <hr>
        </div>
        <div v-else>
            Загрузка...
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrderItemDetails",
        props: ['id'],
        methods: {
            getApiOrder() {
                this.$store.dispatch('getApiOrder', this.id);
            }
        },
        computed: {
            getStoreOrder() {
                return this.$store.getters.ORDER(this.id);
            },
            getStoreOrderTotal() {
                return this.$store.getters.ORDERTOTAL(this.id);
            }
        },
        created() {
            this.getApiOrder();
        }

    }
</script>

<style scoped>

</style>