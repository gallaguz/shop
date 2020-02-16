<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\SessionEntity;

class UserController extends Controller
{
    public function actionGetProfile()
    {
        $params = [
            'error' => false,
            'auth' => !is_null(App::call()->session->getUsername()),
            'username' => App::call()->session->getUsername(),
            'user_id' => App::call()->session->getUser_id(),
            'phone' => '+12345678900',
            'email' => 'email@email.com'
        ];
        $this->runRender('error', [ 'profile' => $params ]);
    }

    public function actionLogin()
    {
        $username = App::call()->request->getParams()['username'];
        $password = App::call()->request->getParams()['password'];

        if (App::call()->validate->loginPass($username, $password)) {
            if (App::call()->userRepository->authentication($username, $password)) {

                $user = App::call()->userRepository->getOneWhere('username', $username);

                App::call()->userRepository->saveVisit($user);
                App::call()->sessionRepository->saveSession($user);

                if ($this->isApi()) {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'error' => false,
                        'username' => App::call()->session->getUsername()]);
                } else {
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $params = [
                    'error' => 'Неверный логин или пароль'
                ];
                $this->runRender('error', $params);
            };
        } else {
            $params = [
                'error' => 'Неверный формат ввода'
            ];
            $this->runRender('error', $params);
        }
    }

    public function actionLogout() {
        $user = App::call()->userRepository->getOneWhere('username', App::call()->session->getUsername());

        if ($user) {
            $user->hash = '';
            App::call()->userRepository->save($user);
        }

        App::call()->orderRepository->saveCart();

        App::call()->session->newSession();

        setcookie("hash", '', time() - 60*60*24*7, "/");

        if ($this->isApi()) {
            header('Content-Type: application/json');
            echo json_encode(['error' => false]);
        } else {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

}