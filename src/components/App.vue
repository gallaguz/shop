<template>
    <div>
        <Header/>

        <router-view />

        <Footer />
    </div>
</template>

<script>
    import store from '../store/index.js';

    import Header from './elements/Header.vue';
    import Footer from './elements/Footer.vue';

    export default {
        name: 'App',
        components: {
            Header,
            Footer
        },
        created () {
            this.getUser();
            this.getApiCart();
        },
        methods: {
            getUser() {
                store.dispatch('getApiProfile');
            },

            getApiCart() {
                store.dispatch('getApiCart');
            }
        },
        computed: {
            filteredItems() {
                return this.items.filter((item) => {
                    const regexp = new RegExp(this.query, 'i');

                    return regexp.test(item.title);
                });
            },
            getStoreUserId () {
                return store.getters.getUserId;
            },
            getStoreAuth () {
                return store.getters.getAuth;
            },
            getStoreUsername () {
                return store.getters.getUsername;
            }
        }
    }
</script>

<style lang="scss">
    .app {
        background-color: aqua;
    }
</style>