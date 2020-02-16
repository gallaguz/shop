<template>
    <div>
        <h3>
            {{ item.title }}
        </h3>
        <img width="300" :src="imgDir+item.img"/>
        <p>
            <b>Описание: </b>{{ item.description }}
        </p>

        Цена: {{ item.price }} денег
    </div>
</template>

<script>

    export default {
        name: "CardPage",
        data: function () {
            return {
                item: [],
                imgDir: '/img/'
            }
        },
        props: ['id'],
        methods: {
            getCard(id) {
                fetch('/api/product/', {
                    method: 'POST',
                    body: JSON.stringify({
                        action: 'card',
                        id: id
                    }),
                    headers: {
                        'Content-type': 'application/json',
                    },
                })
                    .then(res => res.json())
                    .then(res => {
                        this.item = res.card;
                    });
            }
        },
        mounted() {
            this.getCard(this.$route.params.id);
        }
    }
</script>

<style scoped>

</style>