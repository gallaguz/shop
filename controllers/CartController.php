<?php


namespace app\controllers;


use app\engine\App;

use app\models\entities\CartEntity;
use app\models\repositories\CartRepository;
use mysql_xdevapi\Exception;

class CartController extends Controller
{
    public function actionIndex()
    {
        $session_id = App::call()->session->getSession_id();
        $order = App::call()->orderRepository->getOneWhere('session_id', App::call()->session->getSession_id());
        $status = $order->status;

        $cart = App::call()->cartRepository->getCart($session_id);
        $count = App::call()->cartRepository->getCountWhere('session_id', $session_id);

        echo $this->render('cart', ['products' => $cart, 'status' => $status,
            'count' => $count, 'session_id' => App::call()->session->getSession_id()]);
    }

    public function actionGetCart()
    {
        $cart = App::call()->cartRepository->getCart(App::call()->session->getSession_id());
        header('Content-Type: application/json');
        echo json_encode(['cart' => $cart]);
    }

    public function actionGetCount()
    {
        $count = App::call()->cartRepository->getCountWhere('session_id', App::call()->session->getSession_id());
        header('Content-Type: application/json');
        echo json_encode(['count' => $count]);
    }

    public function actionDelete()
    {
        $id = App::call()->request->getParams()['id'];
        $cart = App::call()->cartRepository->getOne($id);

        $session_id = App::call()->session->getSession_id();

        if ($session_id == $cart->session_id) {
            App::call()->cartRepository->delete($cart);
        }

        if (App::call()->request->getParams()['api']) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'ok', 'id' => $id, 'count' => App::call()->cartRepository->getCountWhere('session_id',
                $session_id)]);
        } else {
            echo 'Товар удалён из корзины.';
            //echo $this->render('cart', ['error' => 'Что-то пошло не так']);
        }

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

        // Если запрос был асинхронным, выводим json
        if (App::call()->request->getParams()['api']) {
            $this->apiJson(
                ['status' => 'ok',
                    'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id)]
            );
        }
        // А если нет, то я не придумал ещё)
    }

    public function actionUpdateCount()
    {
        $cart_id = App::call()->request->getParams()['id'];

        $cart = App::call()->cartRepository->getOne($cart_id);
        if ($cart){
            $count = App::call()->request->getParams()['count'];
            $cart->count = (is_null($count))? $cart->count + 1 : $count;
            App::call()->cartRepository->save($cart);

            if (App::call()->request->getParams()['api']) {
                $this->apiJson(['status' => 'ok', 'count' => $cart->count]);
            }
        }
    }
}
