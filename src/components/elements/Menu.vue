<template>
    <ul>
        <li>
            <router-link to="/">
                Главная
            </router-link>
        </li>
        <li>
            <router-link to="/catalog">
                Каталог
            </router-link>
        </li>
        <li>
            <router-link to="/cart">
                Корзина {{ count }}
            </router-link>
        </li>
        <li v-if="getStoreUsername === 'admin'">
            <router-link to="/admin">
                Админ панель
            </router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Menu",
        props: [],
        computed: {
            count() {
                return this.$store.getters.getCartCount;
            },
            getStoreUsername () {
                return this.$store.getters.getUsername;
            }
        }
    }
</script>

<style scoped>

</style>