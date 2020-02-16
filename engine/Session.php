<?php


namespace app\engine;


use app\models\entities\UserEntity;

class Session
{
    public function __set($name, $value)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'name' => $name,
                'value' => $value
            ]
        ]);
        $_SESSION[$name] = $value;
    }
    public function __get($name)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'name' => $name
            ]
        ]);
        return $_SESSION[$name];
    }
    public function newSession()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'unset' => [
                    'username',
                    'user_id'
                ]
            ]
        ]);
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        $this->regenerateSession_id();
    }
    public function getSession_id()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'session_id' => session_id()
            ]
        ]);
        return session_id();
    }
    public function getUsername()
    {
        _log([
        'dir' => __DIR__,
        'file' => __FILE__,
        'line' => __LINE__,
        'class' => get_called_class(),
        'method'=> __METHOD__
    ]);
        return $_SESSION['username'];
    }
    public function setUsername(UserEntity $user)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'username' => $user->username
            ]
        ]);
        $_SESSION['username'] = $user->username;
    }
    public function regenerateSession_id()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return session_regenerate_id();
    }
    public function getUser_id()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'user_id' => $_SESSION['user_id']
            ]
        ]);
        return $_SESSION['user_id'];
    }
    public function setUser_id(UserEntity $user)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => [
                'user_id' => $user->id
            ]
        ]);
        $_SESSION['user_id'] = $user->id;
    }
}