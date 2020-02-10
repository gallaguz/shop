<?php


namespace app\models\repositories;


use app\models\entities\Session;
use app\models\Repository;

class SessionRepository extends Repository
{
    public function getEntityClass()
    {
        return Session::class;
    }
    public function getTableName()
    {
        return "sessions";
    }
}