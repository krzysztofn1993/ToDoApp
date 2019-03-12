<?php
session_start();
require_once("../vendor/autoload.php");

use Core\Router;


$router = new Router;
$router->goTo($_SERVER['QUERY_STRING']);

?>
