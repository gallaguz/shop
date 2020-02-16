<?php


namespace app\controllers;


use app\engine\App;

use app\models\entities\CartEntity;
use app\models\repositories\CartRepository;

class CartController extends Controller
{
    public function actionIndex()
    {
        $this->actionGet();
    }

    public function actionGet()
    {
        $id = App::call()->request->getParams()['id'];

        if (!is_null($id)) {
            $cart = App::call()->cartRepository->getOne($id);
        } else {
            $cart = App::call()->cartRepository->getCart();
        }

        $params = [
            'error' => false,
            'cart' => $cart
        ];

        $this->runRender('cart', $params);
    }

    public function actionDelete()
    {
        $id = App::call()->request->getParams()['id'];
        $cart = App::call()->cartRepository->getOneWhereAnd('session_id', App::call()->session->getSession_id(), 'product_id', $id);

        if ($cart) {
            App::call()->cartRepository->delete($cart);
        }

        $params = [
            'status' => 'ok',
            'msg' => 'deleted'
        ];

        $this->runRender('cart', $params);
    }

    public function actionAdd()
    {
        $product_id = App::call()->request->getParams()['id'];
        $session_id = App::call()->session->getSession_id();

        // Получаем товар из корзины
        $cart = App::call()->cartRepository->getOneWhereAnd('session_id', $session_id, 'product_id', $product_id);

        if ($cart) {
            // Если товар уже есть в корзине, увеличиваем количество
            $cart->count = $cart->count + 1;
        } else {
            // Если товара в корзине нет, создаём
            $user_id = App::call()->session->getUser_id();
            $cart = new CartEntity( $session_id,
                                    $product_id,
                                    is_null($user_id)? 0: $user_id,
                                    App::call()->productRepository->getOne($product_id)->price,
                                    1);
        }
        // Сохраняем корзину
        App::call()->cartRepository->save($cart);

        $params = [
            'status' => 'ok',
            'msg' => 'added'
        ];

        $this->runRender('cart', $params);
    }

    public function actionUpdate()
    {
        $product_id = App::call()->request->getParams()['id'];
        $count = App::call()->request->getParams()['count'];

        $cart = App::call()->cartRepository->getOneWhereAnd
        (
            'session_id',
            App::call()->session->getSession_id(),
            'product_id',
            $product_id
        );

        if ($cart){
            if (!is_null($count) && $count > 0) {
                $cart->count = $count;
                App::call()->cartRepository->save($cart);
            } else {
                $this->actionDelete();
                exit();
            }

            $params = [
                'status' => 'ok',
                'msg' => 'updated'
            ];

            $this->runRender('cart', $params);
        }
    }
}
