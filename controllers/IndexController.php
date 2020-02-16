<?php


namespace app\controllers;

use app\engine\App;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $params = [
            'error' => false,
            'content' => 'Добро пожаловать в наш магазин!'
        ];

        echo $this->render('index', $params);
    }
}