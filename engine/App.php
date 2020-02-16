<?php


namespace app\engine;

use app\controllers\CartController;
use app\controllers\Controller;
use app\engine\Session;
use app\models\repositories\SessionRepository;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;

/**
 * Class App
 *
 *
 * @property Session $session
 * @property Request $request
 * @property Validate $validate
 * @property Db $db
 * @property SessionRepository $sessionRepository;
 *
 * @property CartController $cartController
 *
 * @property CartRepository $cartRepository
 * @property UserRepository $userRepository
 * @property ProductRepository $productRepository
 * @property OrderRepository $orderRepository
 *
 *
 */
class App
{
    use TSingletone;

    public $config;

    private $controllers;

    /** @var  Storage */
    //хранилище компонентов-объектов
    private $components;

    private $session;

    private $controller;
    private $action;

    /**
     * @return static
     */
    public static function call()
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'return static::getInstance()'
        ]);
        return static::getInstance();
    }

    public function runController($controller = false, $action = false, $api = false)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Входящие параметры',
            'params' => [
                'controller' => $controller,
                'action' => $action,
                'api' => $api
                ]
            ]);
        $this->controller = ($controller)? $controller : $this->request->getControllerName() ?: 'index';
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Определение контроллера',
            'params' => [
                'Имяконтроллера' => $this->controller
            ]
        ]);
        $this->action = ($action)? $action : $this->request->getActionName();
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Определение действия',
            'params' => [
                'action' => $this->action
            ]
        ]);
        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Класс контроллера',
            'params' => [
                'name' => $controllerClass
            ]
        ]);
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Проверка на существование класса контроллера',
            'params' => [
                'name' => $controllerClass
            ]
        ]);
        if (class_exists($controllerClass)) {
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Класс контроллера существует',
                'params' => [
                    'name' => $controllerClass
                ]
            ]);
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Создание екземпляра контроллера и передача рендера в конструктор',
                'params' => [
                    'controller' => $controllerClass,
                    'render' => 'TwigRender'
                ]
            ]);
            $controller = new $controllerClass(new TwigRender());
            //$controller = new $controllerClass(new Render());
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Запуск действия контроллера',
                'params' => [
                    'controller' => $controllerClass,
                    'action' => $this->action,
                    'api' => $api
                ]
            ]);
            $controller->runAction($this->action, $api);
        } else {
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Контроллер не найден'
            ]);
            echo "Такого контроллера нет...";
        }
    }

    public function createComponent($name)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Старт создания екземпляра',
            'params' => [
                'name' => $name
            ]
        ]);
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Компонент найден в конфигурационном файле',
                'params' => [
                    'name' => $this->config['components'][$name],
                    'params' => $params,
                    'class' => $class
                ]
            ]);
            if (class_exists($class)) {
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'Существует ли такой класс',
                    'name' => $class
                ]);
                unset($params['class']);
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'unset($params[\'class\'])'
                ]);
                try {
                    _log([
                        'dir' => __DIR__,
                        'file' => __FILE__,
                        'line' => __LINE__,
                        'class' => get_called_class(),
                        'method'=> __METHOD__,
                        'comment' => 'Попытка создания и возврат екземпляра класса, в случае успеха',
                        'name' => $class,
                        'params' => $params
                    ]);
                    $reflection = new \ReflectionClass($class);
                    return $reflection->newInstanceArgs($params);
                } catch (\ReflectionException $e) {
                    _log([
                        'dir' => __DIR__,
                        'file' => __FILE__,
                        'line' => __LINE__,
                        'class' => get_called_class(),
                        'method'=> __METHOD__,
                        'comment' => 'Не удалось создать екземпляр класса',
                        'name' => $class,
                        'params' => $params,
                        'error' => $e
                    ]);
                }
            }
        }
        if (isset($this->config['repository'][$name])) {
            $params = $this->config['repository'][$name];
            $class = $params['class'];
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Репозиторий найден в конфигурационном файле',
                'params' => [
                    'name' => $this->config['repository'][$name],
                    'params' => $params,
                    'class' => $class
                ]
            ]);
            if (class_exists($class)) {
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'Класс существует',
                    'name' => $class
                ]);
                unset($params['class']);
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'unset($params[\'class\'])'
                ]);
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'Взврат екземпляра'
                ]);
                return new $class;
            }
        }
        if (isset($this->config['controller'][$name])) {
            $params = $this->config['controller'][$name];
            $class = $params['class'];
            _log([
                'dir' => __DIR__,
                'file' => __FILE__,
                'line' => __LINE__,
                'class' => get_called_class(),
                'method'=> __METHOD__,
                'comment' => 'Контроллер найден в конфигурационном файле',
                'params' => [
                    'name' => $this->config['controller'][$name],
                    'params' => $params,
                    'class' => $class
                ]
            ]);
            if (class_exists($class)) {
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'Класс существует',
                    'name' => $class
                ]);
                unset($params['class']);
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'unset($params[\'class\'])'
                ]);
                _log([
                    'dir' => __DIR__,
                    'file' => __FILE__,
                    'line' => __LINE__,
                    'class' => get_called_class(),
                    'method'=> __METHOD__,
                    'comment' => 'Взврат екземпляра'
                ]);
                return new $class;
            }
        }
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Не найден в конфигурационном файле. Возврат null',
            'name' => $name
        ]);
        return null;
    }

    public function run($config)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'params' => '$config'
        ]);
        $this->config = $config;
        $this->components = new Storage();
        $this->session = new Session();
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Установка значений',
            'params' => [
                '$this->config' => '$config',
                '$this->components' => 'new Storage()',
                '$this->session' => 'new Session()'
            ]
        ]);
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => 'Запуск контроллера',
            'params' => '$this->runController()'
        ]);
        $this->runController();
    }

    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    function __get($name)
    {
        _log([
            'dir' => __DIR__,
            'file' => __FILE__,
            'line' => __LINE__,
            'class' => get_called_class(),
            'method'=> __METHOD__,
            'comment' => '__get',
            'name' => $name
        ]);
        return $this->components->get($name);
    }

}