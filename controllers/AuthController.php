<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\Order;

class AuthController extends Controller
{
    public function actionLogin() {

        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];

        if (App::call()->userRepository->authentication($login, $pass)) {
            $user = App::call()->userRepository->getOneWhere('login', $login);
            $user->hash = App::call()->userRepository->hash();

            App::call()->userRepository->save($user);

            App::call()->session->setLogin($login);
            App::call()->session->setUser_id($user->id);

            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo $this->render('error', ['error' => 'login', 'msg' => 'Неверный логин или пароль']);
        };
    }

    public function actionLogout() {
        $user = App::call()->userRepository->getOneWhere('login', App::call()->session->getLogin());

        if ($user) {
            $user->hash = '';
            App::call()->userRepository->save($user);
        }

        // Сохраняем текущую корзину в новый заказ
        App::call()->orderRepository->saveCurrent();

        App::call()->session->setUser_id(null);
        App::call()->session->setLogin(null);
        App::call()->session->regenerateSession_id();

        setcookie("hash", '', time() - 60*60*24*7, "/");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    }

}