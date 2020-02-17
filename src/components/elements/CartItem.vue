<template>
    <div>
        <h3>{{ this.item.title }}</h3>
        <input
                :value="this.item.count"
                @input="handleQuantityChange"
                class="count"
                type="number"
        />
        <button
                @click="handleDeleteClick"
        >x</button>
        {{ this.item.price }} x
        {{ this.item.count }} =
        {{ this.item.price * this.item.count }}
    </div>
</template>

<script>
    export default {
        name: "CartItem",
        props: ['item'],
        methods: {
            handleQuantityChange(event) {
                this.$emit('changed', {
                    id: this.item.id,
                    count: event.target.value
                });
            },
            handleDeleteClick() {
                this.$emit('deleted', this.item.id);
            }
        }
    }
</script>

<style scoped>

</style>