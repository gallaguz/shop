<template>
    <div>
        <h3>{{title}}</h3>
        <input
                :value="count"
                @input="handleQuantityChange"
                class="count"
                type="number"
        />
        <button
                @click="handleDeleteClick"
        >x</button>
        {{price}} x {{count}} = {{price * count}}
    </div>
</template>

<script>
    export default {
        name: "CartItem",
        props: ['id', 'title', 'count', 'price'],
        methods: {
            handleQuantityChange(event) {
                this.$emit('changed', { id: this.id, count: event.target.value });
            },
            handleDeleteClick() {
                this.$emit('deleted', this.id);
            }
        }
    }
</script>

<style scoped>

</style>