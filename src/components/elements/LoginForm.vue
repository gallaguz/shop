<template>
    <div>
        <label>
            <input
                    v-model="username"
                    type="text" name="username"
                    placeholder="Логин"
                    autocomplete="username"
            >
            Логин
        </label>
        <br>
        <label>
            <input
                    v-model="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
            >
            Пароль
        </label>
        <br>
        <label>
            Оставаться на сайте:
            <input
                    v-model="save"
                    type='checkbox'
                    name='save'
                    value="save"
            >
        </label>
        <input
                v-on:click="logIn"
                type="submit"
                name="submit"
                value="Войти"
        >
    </div>
</template>

<script>
    export default {
        name: "LoginForm",
        data: function () {
            return {
                username: '',
                password: '',
                save: null
            }
        },
        methods: {
            logIn() {
                this.$store.dispatch('logIn',
                    {
                        username: this.username,
                        password: this.password,
                        save: this.save
                    }
                );
            }
        }
    }
</script>

<style scoped>

</style>