<?php
session_start();
require_once("../vendor/autoload.php");

use Core\Router;
use App\Model\Database;
use App\Middlewares\SessionChecker\SessionChecker;

$db = Database::getInstance();
$router = Router::getInstance();
$session = SessionChecker::getInstance();
$session->sessionCheck();
$router->goTo($_SERVER['QUERY_STRING']);
