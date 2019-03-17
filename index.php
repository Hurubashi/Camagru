<?php
/**
 * Created by PhpStorm.
 * User: mrybak
 * Date: 17.03.2019
 * Time: 16:02
 */

//include($_SERVER["DOCUMENT_ROOT"]."/connect.php");
//  php -S localhost:8000

// 1. Basic settings

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Connect system files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

// 3. Connect DB


// 4. Call Router

$router = new Router();
$router->run();


?>
