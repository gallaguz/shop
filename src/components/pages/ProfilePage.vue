<template>
    <div v-if="getStoreAuth">
        <h3>
            Профиль:
        </h3>
        user_id: {{ getStoreUserId }} <br>
        username: {{ getStoreUsername }} <br>
        phone: {{ getStorePhone }} <br>
        email: {{ getStoreEmail }} <br>
        <hr>
        История заказов:
        <hr>
        <Orders />
    </div>
    <div v-else>
        Войдите
    </div>
</template>

<script>
    import store from '../../store/index.js';

    import Orders from '../elements/Orders';

    export default {
        name: "ProfilePage",
        components: {
            Orders
        },
        data: function () {
            return {
                orders: []
            }
        },
        methods: {
            getOrders()
            {

            }
        },
        computed: {
            getStoreUserId () {
                return store.getters.getUserId;
            },
            getStoreAuth () {
                return store.getters.getAuth;
            },
            getStoreUsername () {
                return store.getters.getUsername;
            },
            getStorePhone () {
                return store.getters.getPhone;
            },
            getStoreEmail () {
                return store.getters.getEmail;
            }
        }
    }
</script>

<style scoped>

</style>