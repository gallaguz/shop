<?php


namespace app\models\repositories;


use app\engine\App;

use app\models\entities\Cart;
use app\models\Repository;

class CartRepository extends Repository
{
    public function getCart($session) {
        $sql = "SELECT  p.id product_id,
                        b.id cart_id,
                        b.count,
                        p.title,
                        p.description,
                        p.price
                FROM `carts` b,
                     `products` p
                WHERE b.product_id = p.id
                  AND session_id = :session";

        return App::call()->db->queryAll($sql, ['session' => $session]);
    }

    public function getEntityClass()
    {
        return Cart::class;
    }

    public function getTableName()
    {
        return "carts";
    }
}