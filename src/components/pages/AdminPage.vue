<template>
    <div>
        <div v-if="getStoreUsername === 'admin'">
            <h3>
                Список заказов
            </h3>
            <hr>
            <div v-for="item in getOrders">
                <p>
                    Дата: {{item.date}} <br>
                    Имя: {{ item.name }} <br>
                    Телефон: {{ item.phone }}
                </p>

                <p>
                    Статус: <b>{{ item.status }}</b>
                </p>

                <p>
                    Измение статуса: <br>
                    <button @click="changeOrderStatus('Оплачен', item.id)">
                        Оплачен
                    </button>
                    <button @click="changeOrderStatus('Отменён', item.id)">
                        Отменён
                    </button>
                    <button @click="changeOrderStatus('Доставлен', item.id)">
                        Доставлен
                    </button>
                    <button @click="changeOrderStatus('Новый', item.id)">
                        Новый
                    </button>
                </p>

                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminPage",
        methods: {
            changeOrderStatus (status, order_id) {
                this.$store.dispatch('updateApiOrders',
                    {
                        status: status,
                        order_id: order_id
                    });
                //this.getApiOrdersAdmin();
            },
            getApiOrdersAdmin() {
                this.$store.dispatch('getApiOrdersAdmin');
            }
        },
        mounted() {
            this.$store.dispatch('clearQuery');
        },
        created() {
            this.getApiOrdersAdmin();
        },
        computed: {
            getStoreUsername() {
                return this.$store.getters.getUsername;
            },
            getOrders() {
                return this.$store.getters.getOrdersAdmin;
            }
        }
    }
</script>

<style scoped>

</style>