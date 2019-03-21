<?php
session_start();
require_once("../vendor/autoload.php");

use Core\Router;
use App\Model\Database;

$db = Database::getInstance();
$router = new Router;
$router->goTo($_SERVER['QUERY_STRING']);
?>
