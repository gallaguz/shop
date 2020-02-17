<template>
    <div>
        <span class="showDetailsLink" @click="showDetails">Дата: {{ item.date }}</span>
        <div>
            <OrderItemDetails
                    :id="item.id"
                    v-if="detailsSeen" />
        </div>
    </div>
</template>

<script>
    import OrderItemDetails from './OrderItemDetails'

    export default {
        name: "OrderItem",
        components: {
            OrderItemDetails
        },
        props: ['item'],
        data: function () {
            return {
                detailsSeen: false
            }
        },
        methods: {
            showDetails() {
                //this.$store.dispatch('getApiOrder', this.id);
                this.detailsSeen = !this.detailsSeen;
            }
        }
    }
</script>

<style lang="scss">
    .showDetailsLink:hover {
        color: grey;
        cursor: pointer;
    }
</style>