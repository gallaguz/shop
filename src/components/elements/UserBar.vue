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
    import store from '../../store/index.js';

    export default {
        name: "UserBar",
        data: function () {
            return {}
        },
        methods: {
            logout() {
                store.dispatch('logOut');
            }
        },
        computed: {
            getStoreUsername () {
                return store.getters.getUsername;
            },
            getStoreUserId () {
                return store.getters.getUserId;
            }
        }
    }
</script>

<style scoped>

</style>