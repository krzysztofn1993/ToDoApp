<?php

use src\Controller\Controller;

require("../vendor/autoload.php");

$control = new Controller();
if(isset($_GET['id'])){
    $control->deleteTask($_GET['id']);
} else {
    $control->addTask($_POST['task']);

}

header('Location:../public/index.php');
?>