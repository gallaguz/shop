<?php


namespace app\models\entities;


use app\models\Model;

class Product extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $price;
    protected $image;

    protected $props = [
        'title' => false,
        'description' => false,
        'price' => false,
        'image' => false
    ];

    public function __construct($title = null, $description = null, $price = null, $image = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
    }
}
