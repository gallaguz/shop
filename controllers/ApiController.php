<?php


namespace app\controllers;


use app\engine\App;
use app\models\entities\CartEntity;

class ApiController extends Controller
{
    public function actionIndex()
    {
        $params = [
            'error' => false,
            'content' => 'Welcome to ShopAPI'
        ];
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => $params
        ]);
        header('Content-Type: application/json');
        echo json_encode($params);
    }

    public function actionFile() {
//
//        $params = [
//            'error' => false,
//            'file' => $_FILES['name'],
//            'title' => App::call()->request->getParams()['title'],
//            'price' => App::call()->request->getParams()['price'],
//            'description' => App::call()->request->getParams()['description']
//        ];
//
//        //$action = App::call()->request->getParams()['action'];
//        //App::call()->runController('product', $action, true);
//        header('Content-Type: application/json');
//        echo json_encode($params);
    }

    public function actionProduct()
    {
        $action = App::call()->request->getParams()['action'];
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => '',
            'params' => [
                'controller' => 'product',
                'action' => $action,
                'api' => 'true'
            ]
        ]);
        App::call()->runController('product', $action, true);
    }
    public function actionCart()
    {
        $action = App::call()->request->getParams()['action'];
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => '',
            'params' => [
                'controller' => 'cart',
                'action' => $action,
                'api' => 'true'
            ]
        ]);
        App::call()->runController('cart', $action, true);
    }
    public function actionOrder()
    {
        $action = App::call()->request->getParams()['action'];
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => '',
            'params' => [
                'controller' => 'order',
                'action' => $action,
                'api' => 'true'
            ]
        ]);
        App::call()->runController('order', $action, true);
    }
    public function actionUser()
    {
        $action = App::call()->request->getParams()['action'];
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => '',
            'params' => [
                'controller' => 'user',
                'action' => $action,
                'api' => 'true'
            ]
        ]);
        App::call()->runController('user', $action, true);
    }
}