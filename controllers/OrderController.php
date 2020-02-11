<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\OrderEntity;
use app\models\repositories\OrderRepository;


class OrderController extends Controller
{
    public function actionIndex()
    {
        if (!is_null(App::call()->session->getUser_id())) {
            $orders = App::call()->orderRepository->getAllWhere('user_id', App::call()->session->getUser_id());
        } else {
            // Все заказы текущщей сессии
            $orders = App::call()->orderRepository->getAllWhere('session_id', App::call()->session->getSession_id());
        }

        echo $this->render('orders', ['orders' => $orders]);
    }

    public function actionGet()
    {

        if (App::call()->userRepository->isAuth()) {
            $order = App::call()->orderRepository->getOneWhere('id', App::call()->request->getParams()['id']);
            $status = $order->status;

            $cart = App::call()->cartRepository->getCart($order->session_id);
        } else {
            $cart = App::call()->cartRepository->getCart(App::call()->session->getSession_id());

            $status = 0;
        }

        echo $this->render('order', ['products' => $cart, 'status' => $status]);
    }

    public function actionAdd()
    {
        $name = App::call()->request->getParams()['name'];
        $phone = App::call()->request->getParams()['phone'];
        App::call()->orderRepository->saveCart($name, $phone);

        App::call()->session->regenerateSession_id();

        echo $this->render('orderComplete');
    }
}