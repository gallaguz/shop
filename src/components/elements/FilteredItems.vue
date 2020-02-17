<template>
    <div>
        <div v-if="getFilteredItems">
            <div v-if="getQuery.length > 1">
                <div v-for="item in getFilteredItems">
                    {{ item.title }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FilteredItems",
        props: ['filteredItems'],
        computed: {
            getFilteredItems () {
                return this.$store.getters.getFilteredItems;
            },
            getQuery() {
                return this.$store.getters.getQuery;
            }
        }
    }
</script>

<style scoped>

</style>