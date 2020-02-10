<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\Order;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getEntityClass()
    {
        return Order::class;
    }

    public function saveCurrent($name = null, $phone = null)
    {
        if (App::call()->cartRepository->getCountWhere('session_id', App::call()->session->getSession_id()) > 0) {
            // сохраняем текущую корзину
            $session_id = App::call()->session->getSession_id();
            $user_id = (int)App::call()->session->getUser_id();
            $order = new Order($session_id, $user_id, $name, $phone,1);

            App::call()->orderRepository->save($order);
        }
    }

    public function getTableName()
    {
        return "orders";
    }
}