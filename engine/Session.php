<?php


namespace app\engine;


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

    public function getSession_id()
    {
        return session_id();
    }
    public function getLogin()
    {
        return $_SESSION['login'];
    }
    public function setLogin($login)
    {
        $_SESSION['login'] = $login;
    }
    public function regenerateSession_id()
    {
        return session_regenerate_id();
    }
    public function getPass()
    {
        return $_SESSION['pass'];
    }
    public function getHash()
    {
        return $_SESSION['hash'];
    }
    public function getUser_id()
    {
        return $_SESSION['user_id'];
    }
    public function setUser_id($user_id)
    {
        $_SESSION['user_id'] = $user_id;
    }
}