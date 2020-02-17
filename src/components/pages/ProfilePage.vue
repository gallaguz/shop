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
        <Orders/>
    </div>
    <div v-else>
        Войдите
    </div>
</template>

<script>
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
            getUser() {
                this.$store.dispatch('getApiProfile');
            }
        },
        created() {
            this.getUser();
        },
        mounted() {
            this.$store.dispatch('clearQuery');
        },
        computed: {
            getStoreUserId() {
                return this.$store.getters.getUserId;
            },
            getStoreAuth() {
                return this.$store.getters.getAuth;
            },
            getStoreUsername() {
                return this.$store.getters.getUsername;
            },
            getStorePhone() {
                return this.$store.getters.getPhone;
            },
            getStoreEmail() {
                return this.$store.getters.getEmail;
            }
        }
    }
</script>

<style scoped>

</style>