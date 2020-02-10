<?php


namespace app\models\entities;


use app\models\Model;

class User extends Model
{
    protected $id;
    protected $login;
    protected $pass;
    protected $hash;

    protected $props = [
        'login' => false,
        'pass' => false,
        'hash' => false
    ];

    public function __construct($login = null, $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->pass = $pass;
        $this->hash = $hash;
    }
}