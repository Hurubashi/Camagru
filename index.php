<?php

// 1. Basic settings

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Connect system files
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/router/Router.php');

// 3. Connect DB
require_once(ROOT. '/config/connectDb.php');
new Database();

// 4. Call Router
$router = new Router();
$router->run();


?>
