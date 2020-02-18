<template>
    <div class="catalogItem">
        <h4 class="descriptionSeen">
            <router-link :to="`/product/${this.item.id}`">
                {{ this.item.title }}
            </router-link>
        </h4>

        <img @click="descriptionSeen = !descriptionSeen"
             v-if="descriptionSeen"
             class="catalogItemImg"
             width="300"
             :src="big"
        />
        <img @click="descriptionSeen = !descriptionSeen"
             v-else
             class="catalogItemImg"
             width="100"
             :src="small"
        />

        <div v-if="descriptionSeen">
            <h4>
                Описание товара:
            </h4>
            <p>
                {{ this.item.description }}
            </p>
        </div>

        <div>
            Цена: {{ this.item.price }} денег
        </div>

        <button @click="handleBuyClick">Купить</button>
    </div>
</template>

<script>
    export default {
        name: "CatalogItem",
        props: ['item'],
        data: function () {
            return {
                small: '/img/small/' + this.item.img,
                big: '/img/big/' + this.item.img,
                descriptionSeen: false
            }
        },
        methods: {
            handleBuyClick() {
                this.$store.dispatch('handleBuyClick', this.item);
            }
        }
    }
</script>

<style lang="scss">
    .catalogItem {
        margin-bottom: 10px;
    }

    .descriptionSeen:hover {
        cursor: pointer;
    }

    .catalogItem:hover {
        cursor: pointer;
    }
</style>