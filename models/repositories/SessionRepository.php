<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\SessionEntity;
use app\models\Repository;

class SessionRepository extends Repository
{
    public function saveSession($user)
    {
        App::call()->session->setUsername($user);
        App::call()->session->setUser_id($user);

        $session = new SessionEntity(App::call()->session->getSession_id(), App::call()->session->getUser_id());
        $this->save($session);
    }
    public function getEntityClass()
    {
        return SessionEntity::class;
    }
    public function getTableName()
    {
        return "sessions";
    }
}