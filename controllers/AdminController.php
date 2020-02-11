<?php


namespace app\controllers;


use app\engine\App;

class AdminController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('error', ['error' => 'no']);
    }
    public function actionTest()
    {
        echo $this->render('test2', []);
    }
    public function actionPanel()
    {
        if (App::call()->session->getLogin() === 'admin') {
            echo 'God';
        } else {
            echo 'Sorry)';
        }
    }
}