<?php

namespace App\Controller;

use App\Model\Database;


class Home {

    private $dataBase;

    public function __construct()
    {
        $this->dataBase = Database::getInstance();
    }

    public function index()
    {   
        if(isset($_SESSION['U_ID']) && $_SESSION['U_ID'] !=='' ) {
            $tasks = $this->dataBase->getUserTasks($_SESSION['U_ID']);
        }
        require_once('../App/Views/content/Home.php');
    }

    public function addTask()
    {
        $task = $_POST['task'];
        $this->dataBase->addTask($task, $_SESSION['U_ID']);
        header('Location: /Projects/ToDoApp/public/');
    }
}

?>
