<?php


namespace app\engine;


class Validate
{
    public $config = [
        'login' => ['length' => 32],
        'pass' => ['length' => 32],
        'email' => ['length' => 32],
        'description' => ['length' => 512],
        'phone' => ['length' => 13]
];
    public function str($str)
    {
        return true;
    }

    public function pass($pass)
    {
        return true;
    }
    public function login($login)
    {
        return true;
    }
    public function name($name)
    {
        if ($this->str($name)) {
            return true;
        } else {
            return false;
        }
    }
    public function email($email)
    {
        return true;
    }
    public function phone($phone)
    {
        return true;
    }

    public function controllerName($controllerName)
    {
        return true;
    }
    public function actionName($actionName)
    {
        return true;
    }
}