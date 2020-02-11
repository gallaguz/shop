<?php

use app\models\entities\ProductEntity;

class ProductTest extends \PHPUnit\Framework\TestCase {
    public function testProduct() {
        $name = "1234567891234567891234879`````vc\']'/l/o.";
        $price = 1;
        $product = new ProductEntity($name, null, $price);
        $this->assertEquals($name, $product->title);
        $this->assertEquals($price, $product->price);
    }
}