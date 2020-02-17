<template>
    <div>
        <input
                type="text"
                v-model="query"
                v-on:keyup="handleSearchClick"
        />
        <button
                @click="handleSearchClick"
        >
            Поиск
        </button>
    </div>
</template>

<script>
    export default {
        name: "Search",
        data() {
            return {
                query: '',
            }
        },
        methods: {
            handleSearchClick() {
                if (this.query.length > 1) {
                    this.$store.dispatch('searchApi', this.query);
                } else {
                    this.$store.dispatch('clearQuery');
                }
            }
        }
    }
</script>

<style scoped>

</style>