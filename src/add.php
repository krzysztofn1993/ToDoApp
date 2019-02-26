<?php

use src\Controller\Controller;

require("../vendor/autoload.php");

$control = new Controller();

$control->addTask($_POST['task']);

header('Location:../public/index.php');
?>