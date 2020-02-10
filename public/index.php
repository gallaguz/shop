<?php
session_start();

use app\engine\App;

$config = include __DIR__ . "/../config/config.php";
include realpath("../vendor/Autoload.php");

try {
    App::call()->run($config);
} catch (\Exception $e) {
    var_dump($e);
}

echo 'new';



