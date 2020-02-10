<?php

use app\models\entities\Cart;

class CartTest extends \PHPUnit\Framework\TestCase {

    // Не работает
//    protected $fixture;
//
//    protected function setUp()
//    {
//        $this->fixture = new Cart();
//    }
//    protected function tearDown()
//    {
//        $this->fixture = NULL;
//    }

    /**
     * @dataProvider providerCart
     */

    public function testCart($a, $b) {
        $cart = new Cart(1, 2, 3, 4, 5);

        $this->assertEquals($a, $cart->{$b});
    }

    public function providerCart()
    {
        return array (
            array (0, 1),
            array (2, 2),
            array (5, 120)
        );
    }


}