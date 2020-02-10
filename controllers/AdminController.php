<?php


namespace app\controllers;


use app\engine\App;

class AdminController extends Controller
{
    public function actionPanel()
    {
        if (App::call()->session->getLogin() === 'admin') {
            echo 'God';
        } else {
            echo 'Sorry)';
        }
    }
}