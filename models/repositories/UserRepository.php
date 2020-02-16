<?php


namespace app\models\repositories;


use app\engine\App;
use app\models\entities\UserEntity;
use app\models\Repository;

class UserRepository extends Repository
{
    public function saveVisit($user)
    {
        $user->hash = $this->hash();
        $this->save($user);
    }

    public function isAuth() {
        $hash = $_COOKIE['hash'];

        if (is_null($hash)) {
            $user = static::getOneWhere('username', App::call()->session->getUsername());
        } else {
            $user = static::getOneWhere('hash', $hash);
        }

        if ($user !== false) {

            App::call()->session->setUsername($user);
            App::call()->session->setUser_id($user);

            return true;
        } else {
            return false;
        }
    }

    public function hash()
    {
        if (!is_null(App::call()->request->getParams()['save'])) {
            $hash = uniqid(rand(), true);
            setcookie("hash", $hash, time() + 60*60*24*7, "/");
            return $hash;
        } else {
            return '';
        }
    }

    public function getName() {
        return App::call()->session->getUsername();
    }

    public function authentication($username, $pass) {
        $user = static::getOneWhere('username', $username);
        if (password_verify($pass, $user->pass)) {

            App::call()->session->setUsername($user);
            App::call()->session->setUser_id($user);

            return true;
        } else {
            return false;
        }
    }

    public function getEntityClass()
    {
        return UserEntity::class;
    }

    public function getTableName()
    {
        return "users";
    }
}