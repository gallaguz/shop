<?php


namespace app\engine;


use app\models\entities\UserEntity;

class Session
{
    public function __set($name, $value)
    {
        $_SESSION[$name] = $value;
    }
    public function __get($name)
    {
        return $_SESSION[$name];
    }

    public function newSession()
    {
        unset($_SESSION['login']);
        unset($_SESSION['user_id']);
        $this->regenerateSession_id();
    }

    public function getSession_id()
    {
        return session_id();
    }
    public function getLogin()
    {
        return $_SESSION['login'];
    }
    public function setLogin(UserEntity $user)
    {
        $_SESSION['login'] = $user->login;
    }
    public function regenerateSession_id()
    {
        return session_regenerate_id();
    }
    public function getUser_id()
    {
        return $_SESSION['user_id'];
    }
    public function setUser_id(UserEntity $user)
    {
        $_SESSION['user_id'] = $user->id;
    }
}