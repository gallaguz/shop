<?php


namespace app\engine;

class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $params;
    private $method;

    public function __construct()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Создание екземпляра Request'
        ]);
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
    }

    private function parseRequest() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $url = explode('/', $this->requestString);
        $this->controllerName = $url[1] ?: 'index';
        $this->actionName = $url[2];
        $this->params = $_REQUEST;
        $data = json_decode(file_get_contents('php://input'));

        if (!is_null($data)) {
            foreach ($data as $key => $elem) {
                $this->params[$key] = $elem;
            }
        }
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Парсинг запроса',
            'action name' => $this->actionName,
            'controller name' => $this->controllerName,
            'data' => $data,
            'params' => $this->params
        ]);
    }
    public function getObj()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this;
    }
    public function getControllerName()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this->controllerName;
    }
    public function getActionName()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this->actionName;
    }
    public function getParams()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this->params;
    }
    public function getMethod()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__
        ]);
        return $this->method;
    }
}