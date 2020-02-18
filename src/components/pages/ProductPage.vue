<template>
    <div>
        id: {{ productId }}
    </div>
</template>

<script>
    export default {
        name: "ProductCardPage",
        props: ['id'],
        watch: {
            // $route(to, from) {
            //     console.log(to);
            //     console.log(from);
            //     console.log(this.$router);
            //     // обрабатываем изменение параметров маршрута...
            // }
        },
        computed: {
            productId() {
                // Мы скоро разберём что такое `params`
                return this.$route.params.id
            }
        },
        methods: {
            goBack() {
                window.history.length > 1 ? this.$router.go(-1) : this.$router.push('/')
            }
        }
    }
</script>

<style scoped>

</style>