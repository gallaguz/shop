<template>
    <div>
        <p>Каталог товаров</p>
        <hr>
        <ul>
            <li v-for="item in getStoreCatalog">
                <CatalogItem
                    :item="item"/>
            </li>
        </ul>


        <button v-on:click="getApiCatalog">Показать ещё</button>
    </div>
</template>

<script>
    import CatalogItem from "../elements/CatalogItem";

    export default {
        name: 'Catalog',
        components: {
            CatalogItem
        },
        methods: {
            getApiCatalog() {
                this.$store.dispatch('getApiCatalog');
            }
        },
        created () {

        },
        mounted() {
            this.getApiCatalog();
            this.$store.dispatch('clearQuery');
        },
        computed: {
            getStoreCatalog () {
                return this.$store.getters.getCatalog;
            }

        }
    }
</script>

<style lang="scss">

</style>