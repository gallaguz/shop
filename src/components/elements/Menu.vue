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
    </ul>
</template>

<script>
    import store from '../../store/index.js';

    export default {
        name: "Menu",
        props: [],
        computed: {
            count() {
                return store.getters.getCartCount;
            }
        }
    }
</script>

<style scoped>

</style>