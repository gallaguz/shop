<?php


namespace app\controllers;


use app\engine\App;

use app\models\entities\CartEntity;
use app\models\repositories\CartRepository;

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

    public function actionOrders()
    {
        echo $this->render('orders', ['orders' => 'orders']);
    }

    public function actionDelete()
    {
        $id = App::call()->request->getParams()['id'];
        $cart = App::call()->cartRepository->getOne($id);

        $session_id = App::call()->session->getSession_id();

        if ($session_id == $cart->session_id) {
            App::call()->cartRepository->delete($cart);
        }

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'id' => $id, 'count' => App::call()->cartRepository->getCountWhere('session_id',
            $session_id)]);
    }

    public function actionAdd()
    {
        $product_id = App::call()->request->getParams()['id'];

        $session_id = App::call()->session->getSession_id();
        $user_id = App::call()->session->getUser_id();

        $cart = App::call()->cartRepository->getOneWhereAnd('session_id', $session_id, 'product_id', $product_id);

        if ($cart) {
            $cart->count = $cart->count + 1;
        } else {
            $cart = new CartEntity($session_id, $product_id);
            $cart->price = App::call()->productRepository->getOne($product_id)->price;
            $cart->user_id = is_null($user_id)? 0: $user_id;
            $cart->count = 1;
        }

        App::call()->cartRepository->save($cart);

        $count = App::call()->cartRepository->getCountWhere('session_id', $session_id);

        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok', 'count' => $count]);
        die();
    }

    public function actionUpdateCount()
    {
        $cart_id = App::call()->request->getParams()['id'];
        $count = App::call()->request->getParams()['count'];

        $cart = App::call()->cartRepository->getOne($cart_id);

        if ($cart) {
            if (is_null($count)) {
                $cart->count = $cart->count + 1;
            } else {
                $cart->count = $count;
            }

            App::call()->cartRepository->save($cart);

            header('Content-Type: application/json');
            echo json_encode(['status' => 'ok', 'count' => $count]);
            die();
        }
    }
}
