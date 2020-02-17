<template>
    <div>
        <div v-if="getStoreUsername === 'admin'">
            <h4 class="adminH4" @click="current = 'orders'">
                Список заказов
            </h4>
            <h4 class="adminH4" @click="current = 'add'">
                Добавить товар
            </h4>
            <h4 class="adminH4" @click="current = 'edit'">
                Редактировать товары
            </h4>
            <hr>
            <div
                    v-if="current === 'orders'"
                    id="orders"
            >
                <div v-for="item in getOrders">
                    <p>
                        Дата: {{item.date}} <br>
                        Имя: {{ item.name }} <br>
                        Телефон: {{ item.phone }}
                    </p>

                    <p>
                        Статус: <b>{{ item.status }}</b>
                    </p>

                    <p>
                        Измение статуса: <br>
                        <button @click="changeOrderStatus('Оплачен', item.id)">
                            Оплачен
                        </button>
                        <button @click="changeOrderStatus('Отменён', item.id)">
                            Отменён
                        </button>
                        <button @click="changeOrderStatus('Доставлен', item.id)">
                            Доставлен
                        </button>
                        <button @click="changeOrderStatus('Новый', item.id)">
                            Новый
                        </button>
                    </p>

                    <hr>
                </div>
            </div>
            <div
                    v-if="current === 'add'"
                    id="add"
            >
                Добавление товара
                <hr>
                <div>
                    <label>Название <br>
                        <input
                                v-model="title"
                                type="text"
                                placeholder="Название товара"
                        >
                    </label>
                    <hr>
                    <label>Цена <br>
                        <input v-model="price"
                                type="text"
                               placeholder="Цена товара"
                        >
                    </label>
                    <hr>
                    <label>Описание <br>
                        <textarea v-model="description"
                                placeholder="Описание товара"
                        ></textarea>
                    </label>
                    <hr>
                    <label>Изображение <br>
                        <input
                                type="file"
                                id="file"
                                ref="file"
                                v-on:change="handleFileUpload()"
                        />
                    </label>
                    <button
                            v-on:click="addProduct()"
                    >
                        Сохранить
                    </button>
                </div>
            </div>
            <div
                    v-if="current === 'edit'"
                    id="edit"
            >
                Редактирование товаров
                <hr>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "AdminPage",
        data: function () {
            return {
                current: 'orders',
                title: '',
                price: '',
                description: '',
                file: ''
            }
        },
        methods: {
            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },
            addProduct() {
                let formData = new FormData();
                    formData.append('action', 'add');
                    formData.append('file', this.file);
                    formData.append('title', this.title);
                    formData.append('price', this.price);
                    formData.append('description', this.description);

                this.$store.dispatch('addProduct', formData);
            },
            changeOrderStatus(status, order_id) {
                this.$store.dispatch('updateApiOrders',
                    {
                        status: status,
                        order_id: order_id
                    });
            },
            getApiOrdersAdmin() {
                this.$store.dispatch('getApiOrdersAdmin');
            }
        },
        mounted() {
            this.$store.dispatch('clearQuery');
        },
        created() {
            this.getApiOrdersAdmin();
        },
        computed: {
            getStoreUsername() {
                return this.$store.getters.getUsername;
            },
            getOrders() {
                return this.$store.getters.getOrdersAdmin;
            }
        }
    }
</script>

<style lang="scss">
    .adminH4 {
        float: left;
        margin: 10px;

        &:hover {
            cursor: pointer;
        }
    }

    hr {
        clear: both;
    }
</style>