<template>
    <div>
        <Header/>
        <hr>
        <Search />
        <FilteredItems />
        <hr>
        <router-view />
        <hr>
        <Footer />
    </div>
</template>

<script>
    import Header from './elements/Header.vue';
    import Footer from './elements/Footer.vue';
    import Search from "./elements/Search";
    import FilteredItems from "./elements/FilteredItems";

    export default {
        name: 'App',
        components: {
            Header,
            Footer,
            Search,
            FilteredItems
        },
        methods: {
            getUser() {
                this.$store.dispatch('getApiProfile');
            },

            getApiCart() {
                this.$store.dispatch('getApiCart');
            }
        },
        created() {
            this.getUser();
        },
        computed: {
            getFilteredItems () {
                return this.$store.getters.getFilteredItems;
            },
            getStoreUserId () {
                return this.$store.getters.getUserId;
            },
            getStoreAuth () {
                return this.$store.getters.getAuth;
            },
            getStoreUsername () {
                return this.$store.getters.getUsername;
            }
        }
    }
</script>

<style lang="scss">
    .app {
        background-color: aqua;
    }
</style>