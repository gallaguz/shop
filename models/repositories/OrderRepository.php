<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\OrderEntity;
use app\models\Repository;

class OrderRepository extends Repository
{
    public function getEntityClass()
    {
        return OrderEntity::class;
    }

    public function saveCart($name = null, $phone = null)
    {
        if (App::call()->cartRepository->getCountWhere('session_id', App::call()->session->getSession_id()) > 0) {
            $session_id = App::call()->session->getSession_id();
            $user_id = (int)App::call()->session->getUser_id();
            $order = new OrderEntity($session_id, $user_id, $name, $phone,'new');

            App::call()->orderRepository->save($order);
        }
    }

    public function getTableName()
    {
        return "orders";
    }
}