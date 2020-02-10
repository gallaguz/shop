<?php


namespace app\models\entities;


use app\models\Model;

class Order extends Model
{
    protected $id;
    protected $session_id;
    protected $user_id;
    protected $name;
    protected $phone;
    protected $status;

    protected $props = [
        'session_id' => false,
        'user_id' => false,
        'status' => false,
        'name' => false,
        'phone' => false
    ];

    public function __construct($session_id = null, $user_id = null, $name = null, $phone = null, $status = null)
    {
        $this->session_id = $session_id;
        $this->user_id = $user_id;
        $this->name = $name;
        $this->phone = $phone;
        $this->status = $status;
    }
}