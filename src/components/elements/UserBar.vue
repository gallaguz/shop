<template>
    <div>
        Добро пожаловать:
        <strong>
            <router-link to="/profile">
                {{ getStoreUsername }}
            </router-link>
        </strong>
        <button
                v-on:click="logout"
        >
            Выход
        </button>
    </div>
</template>

<script>
    export default {
        name: "UserBar",
        data: function () {
            return {}
        },
        methods: {
            logout() {
                this.$store.dispatch('logOut');
            }
        },
        computed: {
            getStoreUsername () {
                return this.$store.getters.getUsername;
            },
            getStoreUserId () {
                return this.$store.getters.getUserId;
            }
        }
    }
</script>

<style scoped>

</style>