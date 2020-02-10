<?php


namespace app\engine;

use app\engine\Session;
use app\models\repositories\SessionRepository;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\traits\TSingletone;

/**
 * Class App
 * @property Session $session
 * @property Request $request
 * @property Validate $validate
 * @property Db $db
 * @property SessionRepository $sessionRepository;
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
        return static::getInstance();
    }

    public function runController()
    {

        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender());
            $controller->runAction($this->action);
        } else {
            echo "Такого контроллера нет...";
        }
    }

    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);

                try {
                    $reflection = new \ReflectionClass($class);
                    return $reflection->newInstanceArgs($params);
                } catch (\ReflectionException $e) {

                }
            }
        }
        if (isset($this->config['repository'][$name])) {
            $params = $this->config['repository'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                return new $class;
            }
        }
        return null;
    }

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->session = new Session();
        $this->runController();
    }

    //Чтобы обращаться к компонентам как к свойствам, переопределим геттер
    function __get($name)
    {
        return $this->components->get($name);
    }

}