<?php
session_start();

use Core\Router;

require_once("../vendor/autoload.php");

$router = new Router;
$router->goTo($_SERVER['QUERY_STRING']);

?>
