<template>
    <div>
        <button @click="seen = !seen"
        >
            Оформить заказ
        </button>
        <p v-if="seen">
            <label>Имя: <br>
                <input v-model="name"
                        type="text" name="name">
            </label><br>
            <label>Номер телефона: <br>
                <input v-model="phone"
                        type="text" name="phone">
            </label><br>
            <input
                    @click="addOrder"
                    type="submit"
                    value="Оформить"
            >

        </p>
    </div>
</template>

<script>
    export default {
        name: "AddOrder",
        data: function () {
            return {
                name: '',
                phone: '',
                seen: false
            }
        },
        methods: {
            addOrder () {
                this.$store.dispatch('addOrder', {
                    name: this.name,
                    phone: this.phone
                });
            }
        },
        computed : {

        }
    }
</script>

<style scoped>

</style>