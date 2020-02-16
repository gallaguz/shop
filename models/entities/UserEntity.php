<?php


namespace app\models\entities;


use app\models\Entity;

class UserEntity extends Entity
{
    protected $id;
    protected $username;
    protected $password;
    protected $hash;

    protected $props = [
        'username' => false,
        'password' => false,
        'hash' => false
    ];

    public function __construct($username = null, $password = null, $hash = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->hash = $hash;
    }
}