<template>
    <div>
        <div v-if="getStoreUsername === 'admin'">
            <h3>
                Список заказов
            </h3>
            <div v-for="item in getOrders">
                <hr>
                {{item.date}} status: {{ item.status }} <br>
                <button>
                    Оплачен
                </button>
                <button>
                    Отменён
                </button>
                <button>
                    Доставлен
                </button>
                <button>
                    Новый
                </button>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminPage",
        methods: {
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