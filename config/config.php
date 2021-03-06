<?php
//define('DS', DIRECTORY_SEPARATOR);
////define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . "/../");
//define("ROOT_DIR", dirname(__DIR__));
//define("TEMPLATES_DIR", dirname(__DIR__) . "/views/");
//define("CONTROLLER_NAMESPACE", "app\\controllers\\");
use app\engine\Request;
use app\engine\Session;
use app\engine\Validate;

use app\controllers\AdminController;
use app\controllers\ApiController;
use app\controllers\CartController;
use app\controllers\OrderController;
use app\controllers\ProductController;
use app\controllers\UserController;

use app\models\repositories\SessionRepository;
use app\models\repositories\CartRepository;
use app\models\repositories\OrderRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\engine\Db;

return [
    'root_dir' => __DIR__ . "/../",
    'templates_dir' => __DIR__ . "/../views/",
    'controllers_namespaces' => 'app\controllers\\',
    'components' => [
        'db' => [
            'class' => Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'shop',
            'charset' => 'utf8'
        ],
        'session' => [
            'class' => Session::class
        ],
        'request' => [
            'class' => Request::class
        ],
        'validate' => [
            'class' => Validate::class
        ]
    ],
    'controller' => [
        'adminController' => [
            'class' => AdminController::class
        ],
        'apiController' => [
            'class' => ApiController::class
        ],
        'cartController' => [
            'class' => CartController::class
        ],
        'orderController' => [
            'class' => OrderController::class
        ],
        'productController' => [
            'class' => ProductController::class
        ],
        'userController' => [
            'class' => UserController::class
        ]

    ],
    'repository' => [
        'sessionRepository' => [
            'class' => sessionRepository::class
        ],
        'cartRepository' => [
            'class' => CartRepository::class
        ],
        'orderRepository' => [
            'class' => OrderRepository::class
        ],
        'productRepository' => [
            'class' => ProductRepository::class
        ],
        'userRepository' => [
            'class' => UserRepository::class
        ]
    ]

];