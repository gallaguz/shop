<?php


namespace app\controllers;

use app\engine\App;
use app\interfaces\IRenderer;

abstract class Controller
{
    private $action;
    private $defaultAction = 'index';
    private $layout = 'main';
    private $useLayout = true;
    private $renderer;


    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    public function apiJson($params)
    {
        header('Content-Type: application/json');
        echo json_encode($params);
    }

    public function render($template, $params = []) {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'login' => $this->renderTemplate('login', [
                    'auth' => App::call()->userRepository->isAuth(),
                    'username' => App::call()->userRepository->getName()
                ]),
                'menu' => $this->renderTemplate('menu', [
                    'count' => App::call()->cartRepository->getCountWhere('session_id', session_id()),
                    'auth' => App::call()->userRepository->isAuth(),
                    'username' => App::call()->userRepository->getName()
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }

}