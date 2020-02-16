<template>
    <div class="header">
        <UserBar
                v-if="getStoreAuth"
        />
        <LoginForm
                v-else
        />
        <Menu/>
    </div>
</template>

<script>
    import store from '../../store/index.js';

    import LoginForm from './LoginForm.vue';
    import UserBar from './UserBar.vue';
    import Menu from './Menu.vue';

    export default {
        name: 'Header',
        components: {
            Menu,
            UserBar,
            LoginForm
        },
        computed: {
            getStoreAuth () {
                return store.getters.getAuth;
            }
        }
    }
</script>

<style lang="scss">

</style>