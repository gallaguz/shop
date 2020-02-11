<?php


namespace app\models\repositories;


use app\models\entities\ProductEntity;
use app\models\Repository;

class ProductRepository extends Repository
{
    public function getEntityClass()
    {
        return ProductEntity::class;
    }

    public function getTableName()
    {
        return "products";
    }
}