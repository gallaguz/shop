<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\SessionEntity;

class UserController extends Controller
{
    public function actionLogin() {

        $login = App::call()->request->getParams()['login'];
        $pass = App::call()->request->getParams()['pass'];

        if (App::call()->validate->loginPass($login, $pass)) {
            if (App::call()->userRepository->authentication($login, $pass)) {

                $user = App::call()->userRepository->getOneWhere('login', $login);

                App::call()->userRepository->saveVisit($user);
                App::call()->sessionRepository->saveSession($user);

                header("Location: " . $_SERVER['HTTP_REFERER']);
            } else {
                echo $this->render('error', ['error' => 'Неверный логин или пароль']);
            };
        } else {
            echo $this->render('error', ['error' => 'Неверный формат ввода']);
        }
    }

    public function actionLogout() {
        $user = App::call()->userRepository->getOneWhere('login', App::call()->session->getLogin());

        if ($user) {
            $user->hash = '';
            App::call()->userRepository->save($user);
        }

        App::call()->orderRepository->saveCart();

        App::call()->session->newSession();

        setcookie("hash", '', time() - 60*60*24*7, "/");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

}