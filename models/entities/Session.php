<?php


namespace app\models\entities;


use app\models\Model;

class Session extends Model
{
    protected $session_id;
    protected $user_id;

    protected $props = [
        'session_id' => false,
        'user_id' => false
    ];

    public function __construct($session_id = null, $user_id = null)
    {
        $this->session_id = $session_id;
        $this->user_id = $user_id;
    }
}