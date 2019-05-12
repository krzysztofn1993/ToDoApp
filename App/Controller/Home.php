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

    public function addTaskAjax()
    {
        $task = $_POST['task'];
        $this->dataBase->addTask($task, $_SESSION['U_ID']);
        $this->getNewTaskAjax();        
    }

    public function removeTaskAjax()
    {
        $task = $_POST['task'];
        $this->dataBase->removeUsersTask($task, $_SESSION['U_ID']);    
    }

    private function getNewTaskAjax(){
        $task = $this->dataBase->getUsersNewTask($_SESSION['U_ID']);
        header('Content-Type: application/json');
        echo json_encode($this->prepareNewTasksAjaxResponse($task));
    }

    private function prepareNewTasksAjaxResponse(array $tasks): array
    {
        $preparedData = [];
        
        foreach ($tasks as $task) {
            $preparedData[] = $task['TASK'];
        }

        return $preparedData;
    }
}

?>
