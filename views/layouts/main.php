<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/css.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
</head>

<body>
<div id="root">
    <h1>Интернет магазин</h1>
    <main>
        <div v-if="auth">
            <a href="/user/profile">{{ login }}</a>
            <a href="/order/">История заказов</a>
            <a href="/user/logout/"> [Выход]</a>
        </div>
        <div v-else>
            <login-form></login-form>
        </div>
        <hr>
        <search-component @search="onQueryChanged"></search-component>
        <hr>

        <img class="cartButton" title="Показать/Скрыть корзину" v-if="cart.length" src="/icons/full.svg"
             @click="toggleCart" width="32"
             height="32">
        <img class="cartButton" title="Показать/Скрыть корзину" v-else src="/icons/empty.svg"  @click="toggleCart" width="32" height="32">

        <hr>
        <div v-if="isCartVisible === false">
            <items-list-component :items="filteredItems" @buy="handleBuyClick"></items-list-component>
        </div>
        <div v-if="isCartVisible">
            <cart-component :items="cart" @changed="handleCartChange" @deleted="handleDeleteClick"></cart-component>
        </div>

        <?=$content?>
    </main>
    {{ menu | raw }}
    {{ content | raw }}
</div>
</body>

</html>