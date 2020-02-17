<template>
    <div>
        <button>
            Оформить заказ
        </button>
        <p>
            <label>Имя: <br>
                <input type="text" name="name">
            </label><br>
            <label>Номер телефона: <br>
                <input type="text" name="phone">
            </label><br>
            <input
                    type="submit"
                    value="Оформить"
            >
        </p>

    </div>
</template>

<script>
    export default {
        name: "AddOrder"
    }
</script>

<style scoped>

</style>