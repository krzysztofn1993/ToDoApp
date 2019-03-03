<?php
session_start();
use src\Controller\DBController;

require("../vendor/autoload.php");

$control = new DBController();
if(isset($_GET['id'])){
    $control->deleteTask($_GET['id']);
} else {
    $control->addTask($_POST['task']);

}
header('Location:../public/index.php');
?>