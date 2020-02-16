

const ProductCard = {
    props: ['item'],
    template:
        '<p>{{ item.title }}</p>'
};
const LoginForm = {
    props: ['auth', 'login'],
    template:
        '       <div v-if="auth">\n' +
        '            <a href="/user/profile">Профиль: {{ login }}</a> | \n' +
        '            <a href="/order/">История заказов</a> | \n' +
        '            <a href="/user/logout/"> [Выход]</a>\n' +
        '        </div>\n' +
        '        <div v-else>\n' +
        '            <form action="/user/login/" method="post">\n' +
        '        <input type="text" name="login" placeholder="Логин">\n' +
        '        <input type="text" name="pass" placeholder="Пароль">\n' +
        '        Save? <input type=\'checkbox\' name=\'save\' value="save">\n' +
        '        <input type="submit" name="submit" value="Войти">\n' +
        '    </form>\n' +
        '        </div>'
};
const CartIcon = {
  props: ['cart', 'count'],
  template:

      '<span v-if="cart.length">' +
      '         <img @click="toggleCart" \n' +
      '             class="cartButton"\n' +
      '             title="Показать/Скрыть корзину"\n' +
      '             src="/icons/full.svg"\n' +
      '             width="32"\n' +
      '             height="32"\n' +
      '             >\n' +
      '{{ count }}' +
      '</span>' +
      '        <img v-else @click="toggleCart"\n' +
      '             class="cartButton"\n' +
      '             title="Показать/Скрыть корзину" \n' +
      '             src="/icons/empty.svg" \n' +
      '             width="32" height="32"\n' +
      '        >',
    methods: {
        toggleCart() {
            this.$emit('toggle-cart');
        }
    }
};
const CartItemComponent = {
    props: ['id', 'title', 'count', 'price'],
    template:
        `<li>
                <h3>{{title}}</h3>
                <input class="count" type="number" :value="count" @input="handleQuantityChange" />
                <button @click="handleDeleteClick">x</button> {{price}} x {{count}} = {{price * count}}
        </li>`,
    methods: {
        handleQuantityChange(event) {
            this.$emit('changed', { id: this.id, count: event.target.value });
        },
        handleDeleteClick() {
            this.$emit('deleted', this.id);
        }
    }
};
const CartComponent = {
    props: ['items'],
    template:
        `<div><h2>Корзина</h2>
                <div class="cart">
                  <ul>
                    <cart-item
                      v-for="item in items"
                      :key="item.id"
                      :title="item.title"
                      :id="item.id"
                      :count="item.count"
                      :price="item.price"
                      @changed="handleQuantityChange"
                      @deleted="handleDelete"
                    ></cart-item>
                  </ul>
                </div>
                <div class="total">Общая стоимость товаров: {{total}} денег</div>
              </div>`,
    computed: {
        total() {
            return this.items.reduce((acc, item) => acc + item.count * item.price, 0);
        },
    },
    components: {
        'cart-item': CartItemComponent,
    },
    methods: {
        handleQuantityChange(item) {
            this.$emit('changed', item);
        },
        handleDelete(id) {
            this.$emit('deleted', id);
        }
    }
};
const ItemComponent = {
    props: ['id', 'title', 'price', 'img'],
    data: function ()
    {
        return {
            url: '/product/card/?id=' + this.id
        }
    },
    template:
        `<p class="item">
              <strong><a v-bind:href="url">{{ title }}</a>
              <span @click="testFunc">open</span></strong><br>
              <img width="100" :src="img" /><br>
              <strong>Цена: {{price}}</strong><br>
              <button class="buy" @click="handleBuyClick">Купить</button>
            </p>`,
    methods: {
        handleBuyClick(id) {
            this.$emit('buy', id);
        },
        testFunc(id) {
            this.$emit('test-func', id);
        }
    }
};
const ItemsListComponent = {
    props: ['items'],
    data: function() {
        return {
            src: '/img/'
        }
    },
    template:
        `<div>
                <h2>Каталог товаров</h2>
                <item-component
                  v-if="items.length"
                  v-for="item in items"
                  :key="item.id"
                  :id="item.id"
                  :title="item.title"
                  :price="item.price"
                  :img="src+item.img"
                  @buy="handleBuyClick(item)"
                  @test-func="testFunc(item)"
                ></item-component>
                <div v-if="!items.length">
                Список товаров пуст
              </div>
             </div>`,
    methods: {
        handleBuyClick(item) {
            this.$emit('buy', item);
        },
        testFunc(item){
            this.$emit('test-func', item);
        }
    },
    components: {
        'item-component': ItemComponent,
    },
};
const SearchComponent = {
    template:
        `<div>
                <input type="text" v-model="query" v-on:keyup="handleSearchClick" /><button @click="handleSearchClick">Поиск</button>
         </div>`,
    data() {
        return {
            query: '',
        }
    },
    methods: {
        handleSearchClick() {
            this.$emit('search', this.query);
        }
    }
};

const app = new Vue({
    el: '#root',
    data: {
        auth: false,
        login: '',
        item: [],
        items: [],
        cart: [],
        query: '',
        isCartVisible: false,
    },
    methods: {
        isAuth: function () {
            fetch(`/user/api/`, {
                method: 'POST',
                body: JSON.stringify({
                    param: 'isAuth'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    this.auth = res.auth;
                    this.login = res.login;
                    console.log(res);
                })
        },
        handleClickProduct(item) {
            console.log(item);
        },
        testFunc(item) {
            let id = item.id;
            fetch(`/product/card/`, {
                method: 'POST',
                body: JSON.stringify(
                    {
                        api: 'api',
                        id: id
                    }
                ),
                headers: {
                    'Content-type': 'application/json',
                }
            }).then(res => res.json())
                .then(res => {
                    this.item = res.product;
                });
        },
        // Добавление товара в корзину
        handleBuyClick(item) {
            const cartItem = this.cart.find((cartItem) => +cartItem.id === +item.id);
            fetch(`/cart/add/`, {
                method: 'POST',
                body: JSON.stringify(
                    {
                        api: 'api',
                        id: item.id
                    }
                ),
                headers: {
                    'Content-type': 'application/json',
                }
            }).then(res => res.json())
                .then(res => {
                    if (cartItem) {
                        cartItem.count++;
                    } else {
                        this.cart.push(
                            {
                                ...item, count: 1
                            }
                        );
                    }
                    console.log(res);
                });
        },

        // Изменение количества и удаление
        handleDeleteClick(id) {
            const cartItem = this.cart.find((cartItem) => +cartItem.id === +id);

            if (cartItem && cartItem.count > 1) {
                fetch(`/cart/update/`, {
                    method: 'POST',
                    body: JSON.stringify(
                        {
                            api: 'api',
                            id: id,
                            count: cartItem.count - 1
                        }
                    ),
                    headers: {
                        'Content-type': 'application/json',
                    }
                }).then(res => res.json())
                    .then(res => {
                        cartItem.count--;
                        console.log(res);
                    });
            } else {
                if (confirm('Вы действительно хотите удалить последний товар?')) {
                    fetch(`/cart/delete/`, {
                        method: 'POST',
                        body: JSON.stringify(
                            {
                                api: 'api',
                                id: id
                            }
                        ),
                        headers: {
                            'Content-type': 'application/json',
                        }
                    })
                        .then(res => res.json())
                        .then(res => {
                            this.cart = this.cart.filter((item) => item.id !== id);
                        });
                }
            }
        },

        // Изменение количества товара
        handleCartChange(item) {
            const cartItem = this.cart.find((cartItem) => +cartItem.id === +item.id);
            cartItem.count = item.count;

            if (cartItem && item.count < 1) {
                if (confirm('Вы действительно хотите удалить последний товар?')) {
                    this.cart = this.cart.filter((itemInCart) => itemInCart.id !== item.id);
                    fetch(`/cart/delete/`, {
                        method: 'POST',
                        body: JSON.stringify(
                            {
                                api: 'api',
                                id: item.id
                            }
                        ),
                        headers: {
                            'Content-type': 'application/json',
                        }
                    })
                        .then(res => res.json())
                        .then(res => {
                            console.log(res);
                        });
                }
            } else {
                fetch(`/cart/update/`, {
                    method: 'POST',
                    body: JSON.stringify(
                        {
                            api: 'api',
                            id: item.id,
                            count: item.count
                        }
                    ),
                    headers: {
                        'Content-type': 'application/json',
                    }
                })
                    .then(res => res.json())
                    .then(res => {
                        console.log(res);
                    });
            }
        },

        // Показать / Скрыть корзину
        toggleCart() {
            this.isCartVisible = !this.isCartVisible;
        },

        // Поиск товара
        onQueryChanged(query) {
            this.query = query;
        }
    },
    mounted() {
        this.isAuth();

        fetch(`/product/get/`, {
            method: 'POST',
            body: JSON.stringify(
                {
                    api: 'api'
                }
            ),
            headers: {
                'Content-type': 'application/json',
            },
        })
            .then(res => res.json())
            .then(res => {
                this.items = res.catalog;
            });

        fetch(`/cart/get/`, {
            method: 'POST',
            body: JSON.stringify(
                {
                    api: 'api'
                }
            ),
            headers: {
                'Content-type': 'application/json',
            },
        })
            .then(res => res.json())
            .then(res => {
                this.cart = res.cart;
            });

    },
    computed: {
        filteredItems() {
            return this.items.filter((item) => {
                const regexp = new RegExp(this.query, 'i');

                return regexp.test(item.title);
            });
        },
        count() {
            return this.cart.reduce((acc, item) => acc + item.count, 0);
        }
    },
    components: {
        'login-form': LoginForm,
        'cart-icon': CartIcon,
        'items-list-component': ItemsListComponent,
        'search-component': SearchComponent,
        'cart-component': CartComponent,
        'product-card': ProductCard
    },
});