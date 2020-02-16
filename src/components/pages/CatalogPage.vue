<template>
    <div>
        <p>Каталог товаров</p>


        <div v-for="item in getStoreCatalog">
            <router-link :to="{ name: 'card', params: { id: item.id, item: item } }">
                {{ item.title }}
            </router-link>
            <br>
            <img width="100" :src="imgDir+item.img"/>
            <br>
            Цена: {{ item.price }} денег <br>
            <button @click="handleBuyClick(item)">Купить</button>
            <hr>
        </div>

        <button v-on:click="getApiCatalog">Показать ещё</button>
    </div>
</template>

<script>
    import store from '../../store/index.js';

    export default {
        name: 'Catalog',
        data: function () {
            return {
                imgDir: '/img/',
                page: 0,
                catalog: [],
                test: []
            }
        },
        methods: {
            getApiCatalog() {
                store.dispatch('getApiCatalog');
            },
            handleBuyClick(item) {
                store.dispatch('handleBuyClick', item);
            }
        },
        created () {

        },
        mounted() {
            this.getApiCatalog();
        },
        computed: {
            getStoreCatalog () {
                return store.getters.getCatalog;
            }

        }
    }
</script>

<style lang="scss">

</style>