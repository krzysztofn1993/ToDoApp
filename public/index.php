<?php
session_start();
require_once("../vendor/autoload.php");

use Core\Router;
use App\Model\Database;


$db = new Database;

// $router = new Router;
// $router->goTo($_SERVER['QUERY_STRING']);

?>