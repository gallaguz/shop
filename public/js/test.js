let cartButton = {
    props: ['cart'],
    template: '<img class="cartButton" v-if="cart.length" src="/icons/full.svg" @click="$emit(\'get-cart\')" width="32"' +
        ' height="32">' +
        '<img class="cartButton" v-else src="/icons/empty.svg" @click="$emit(\'get-cart\')" width="32" height="32">'
};


let loginForm = {
    delimiters: ['${', '}'],
    template: '<form action="/user/login/" method="post">\n' +
        '        <input type="text" name="login" placeholder="Логин">\n' +
        '        <input type="text" name="pass" placeholder="Пароль">\n' +
        '        Save? <input type=\'checkbox\' name=\'save\' value="save">\n' +
        '        <input type="submit" name="submit" value="Войти">\n' +
        '    </form>'
};

let cartComponent = {
    delimiters: ['${', '}'],
    props: ['cart'],
    template: '<ol>' +
        '        <li' +
        '                v-for="item in cart"' +
        '                v-bind:item="item"' +
        '                v-bind:key="item.product_id"' +
        '        >${ item.title } - ${ item.price } <br>' +
        '           <input class="itemCount" type="number" :value="item.count">\n' +
        '           <button class="delete">Удалить</button>' +
        '</li>' +
        '    </ol>'
};

let catalogComponent = {
    delimiters: ['${', '}'],
    props: ['catalog'],
    template: '<ol>' +
        '        <li' +
        '                v-for="item in catalog"' +
        '                v-bind:item="item"' +
        '                v-bind:key="item.product_id"' +
        '        >${ item.title } - ${ item.price }</li>' +
        '    </ol>'
};

const app = new Vue({
    delimiters: ['${', '}'],
    el: '#app',
    components: {
        'cart-button': cartButton,
        'cart-component': cartComponent,
        'catalog-component': catalogComponent,
        'login-form': loginForm
    },
    data: {
        cartSeen: false,
        auth: false,
        login: '',
        catalog: [],
        cart: []
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
                    console.log(res.error);
                })
        },
        getCart: function () {
            fetch(`/cart/get/`, {
                method: 'POST',
                body: JSON.stringify({
                    api: 'api'
                }),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    this.cart = res.cart;
                });

            this.cartSeen = !this.cartSeen;
        },
        getCatalog: function () {
            let params = { param: 'catalog' };

            fetch(`/product/api/`, {
                method: 'POST',
                body: JSON.stringify(params),
                headers: {
                    'Content-type': 'application/json',
                },
            })
                .then(res => res.json())
                .then(res => {
                    this.catalog = res.catalog;
                    console.log(res.error);
                })
        }
    },
    mounted () {
        this.isAuth();
        this.getCatalog();
        this.getCart();
        this.cartSeen = false;
    },
    computed: {
        count() {
            return this.cart.length;
        },
        total() {
            return this.cart.reduce((acc, item) => acc + item.count * item.price, 0);
        }
    }
});


function deleteProduct(id)
{
    (
        async () => {
            const response = await fetch('/cart/api/', {
                method: 'POST',
                headers: new Headers({
                    'Content-Type': 'application/json'
                }),
                body: JSON.stringify({
                    param: 'delete',
                    api: true,
                    id: id
                })
            });
            const answer = await response.json();
            document.getElementById('count').innerText = answer.count;
            document.getElementById('item_' + id).remove();
        }
    )();
}

let by = document.querySelectorAll('.buy');
by.forEach((elem) => {
    elem.addEventListener('click', () => {
        console.log('click');

        let id = elem.getAttribute('data-id');
        let price = elem.getAttribute('data-price');
        (
            async () => {
                const response = await fetch('/cart/api/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        param: 'add',
                        id: id
                    })
                });
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;
            }
        )();
    })
});

let count = document.querySelectorAll('.itemCount');

count.forEach((elem) => {
    elem.addEventListener('change', () => {
        let id = elem.getAttribute('data-id');
        let count = elem.value;
        (
            async () => {
                const response = await fetch('/cart/api/', {
                    method: 'POST',
                    headers: new Headers({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({
                        param: 'update',
                        id: id,
                        count: count
                    })
                });
                const answer = await response.json();

                if (answer.count <= 0) {
                    deleteProduct(id);
                } else {
                    elem.value = answer.count;
                }
            }
        )();
    })
});

let buttons = document.querySelectorAll('.delete');
buttons.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        deleteProduct(id);
    })
});


let showAddOrderFlag = false;
let showAddOrder = document.getElementById('showAddOrder')
showAddOrder.addEventListener('click', () => {
    if (showAddOrderFlag === false) {
        document.getElementById('addOrder').innerHTML =
            '<b>Оформление заказа:</b>\n' +
            '\n' +
            '        <form action="/order/add" method="post">\n' +
            '            <input type="text" name="name" placeholder="Имя"><br>\n' +
            '            <input type="text" name="phone" placeholder="Телефон"><br>\n' +
            '            <input type="hidden" name="id" value="{{ session_id }}">\n' +
            '            <input type="submit" name="addOrder" value="Отправить">\n' +
            '        </form>';
        showAddOrder.setAttribute('value', 'Оформить позже');
        showAddOrderFlag = true;
    } else {
        showAddOrder.setAttribute('value', 'Оформить заказ');
        document.getElementById('addOrder').innerHTML = '';
        showAddOrderFlag = false;
    }
});


// let BasketComponent = {
//     data: function() {
//         return {
//             items: [],
//             count: 0,
//             total: 0
//         }
//     },
//     props: ['test'],
//     methods: {
//         getBasket()
//         {
//             (
//                 async () => {
//                     const response = await fetch('/cart/GetCart/', {
//                         method: 'POST',
//                         headers: new Headers({
//                             'Content-Type': 'application/json'
//                         })
//                     });
//                     const answer = await response.json();
//                     this.items = answer['basket'];
//                     console.log(this.items);
//                 }
//             )();
//         }
//     },
//     mounted () {
//         this.getBasket();
//     },
//     template:
//         '<ol>' +
//         '   <li v-for="item in items">' +
//         '       <h3>{{ item.name }}</h3>' +
//         '       <p>Описание: {{ item.description }}</p>' +
//         '       <p>Цена: {{ item.price }}</p>' +
//         '       <input class="itemCount" type="number" value=":item.count">{{ item.count }}' +
//         '       <button class="delete">Удалить</button>' +
//         '   </li>' +
//         '</ol>'
// };
//
// let BasketProductItem = {
//     props: ['basket_id', 'product_id', 'name', 'description', 'price', 'count'],
//
// };
//
// const app = new Vue({
//     el: '#app',
//     components: {
//         'basket-component': BasketComponent
//         //'auth-buttons': AuthButtonComponent,
//         //'create-buttons': CreateButtonComponent
//     },
//     data: {
//         id: '',
//         price: '',
//         test2: 'test 2',
//         auth: false
//     },
//     methods: {
//         buy: function()
//         {
//
//         },
//         logIn: function()
//         {
//             fetch('api.php?auth=login')
//                 .then(res => res.json())
//                 .then(res => {
//                     if (res) {
//                         this.auth = true;
//                         this.text = 'Logged in';
//                     } else {
//                         this.auth = false;
//                         this.text = 'Login error';
//                     }
//                 });
//         },
//         test: function()
//         {
//             console.log ('App has been mounted');
//         }
//     },
//     mounted () {
//         //this.test();
//     }
// });
// <hr>
// <auth-buttons
// v-bind:text="text"
// v-bind:auth="auth"
// @log-in="logIn"
// @log-out="logOut"
// @is-auth="isAuth">
//     </auth-buttons>

// let AuthButtonComponent = {
//     props: ['text', 'auth'],
//     template:
//         '<div>{{ text }}' +
//         '<button v-if="auth === false" @click="$emit(\'log-in\')">Login</button>' +
//         '<button v-if="auth" @click="$emit(\'log-out\')">Logout</button>' +
//         '<button @click="$emit(\'is-auth\')">isAuth</button>' +
//         '</div>'
// };
//
// let CreateButtonComponent = {
//     template:
//         '<div>' +
//         'Create<br>' +
//         '<button @click="$emit(\'create-product\')">Product</button>' +
//         '<button @click="$emit(\'create-type\')">Type</button>' +
//         '<button @click="$emit(\'create-category\')">Category"</button>' +
//         '<button @click="$emit(\'create-brand\')">Brand"</button>' +
//         '</div>'
// };
// <create-buttons
//     @create-product="createProduct"
//     @create-type="createType"
//     @create-category="createCategory"
//     @create-brand="createBrand">
//     </create-buttons>



