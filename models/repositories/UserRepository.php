<?php


namespace app\models\repositories;


use app\engine\App;
use app\engine\Session;
use app\models\entities\User;
use app\models\Repository;

class UserRepository extends Repository
{
    public function isAuth() {
        $hash = $_COOKIE['hash'];


        // App::call()->session->getSession_id();

        if (is_null($hash)) {
            $user = static::getOneWhere('login', App::call()->session->getLogin());
        } else {
            $user = static::getOneWhere('hash', $hash);
        }

        if ($user !== false) {

            App::call()->session->setLogin($user->login);
            App::call()->session->setUser_id($user->id);

            return true;
        } else {
            return false;
        }
    }
    public function getName() {
        return App::call()->session->getLogin();
    }
    public function authentication($login, $pass) {
        $user = static::getOneWhere('login', $login);
        if (password_verify($pass, $user->pass)) {

            App::call()->session->setLogin($user->login);
            App::call()->session->setUser_id($user->id);

            return true;
        } else {
            return false;
        }
    }
    public function getEntityClass()
    {
        return User::class;
    }
    public function getTableName()
    {
        return "users";
    }
}