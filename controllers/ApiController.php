<?php


namespace app\controllers;


use app\engine\App;

class ApiController extends Controller
{
    public function actionTest()
    {
        $data = json_decode(file_get_contents('php://input'));
        $arr = [];
        if (!is_null($data)) {
            foreach ($data as $key => $elem) {
                $arr[$key] = $elem;
            }
        }

        header('Content-Type: application/json');
        echo json_encode([
            ['id' => 0, 'text' => 'text1'],
            ['id' => 1, 'text' => 'text2'],
            ['id' => 2, 'text' => 'text3'],
            ['id' => 3, 'text' => $arr['qty']]
        ]);
    }
    public function actionGetCountItemsInCart()
    {
        $session_id = App::call()->session->getSession_id();
        $count = App::call()->cartRepository->getCountWhere('session_id', $session_id);

        header('Content-Type: application/json');
        echo json_encode($count);
        die();
    }
    public function actionCart()
    {
        $cart = App::call()->cartRepository->getCart(App::call()->session->getSession_id());
        header('Content-Type: application/json');
        echo json_encode($cart);
//
//        header('Content-Type: application/json');
//        echo json_encode([
//            ['id' => 0, 'title' => 'Мясо', 'price' => 100, 'qty' => 1],
//            ['id' => 1, 'title' => 'Сосиски', 'price' => 200, 'qty' => 2],
//            ['id' => 2, 'title' => 'Хлеб', 'price' => 300, 'qty' => 3],
//            ['id' => 3, 'title' => 'Сало', 'price' => 400, 'qty' => 4]
//        ]);
    }
    public function actionGoods()
    {
        header('Content-Type: application/json');
        echo json_encode([
            ['id' => 0, 'title' => 'Мясо', 'price' => 100, 'img' => ''],
            ['id' => 1, 'title' => 'Сосиски', 'price' => 200, 'img' => ''],
            ['id' => 2, 'title' => 'Хлеб', 'price' => 300, 'img' => ''],
            ['id' => 3, 'title' => 'Сало', 'price' => 400, 'img' => '']
        ]);
    }
}