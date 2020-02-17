<template>
    <div>Добро пожаловать в наш магазин</div>
</template>

<script>
    export default {
        name: 'Home',
        mounted() {
            this.$store.dispatch('clearQuery');
        }
    }
</script>

<style lang="scss">

</style>