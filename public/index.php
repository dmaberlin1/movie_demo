<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config/config.php';

use App\Core\Router;

session_start();

$router=new Router();
$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);