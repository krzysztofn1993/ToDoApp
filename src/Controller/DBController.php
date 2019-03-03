<?php 

namespace src\Controller;
use src\Model\Task;



class DBController
{
    protected $task;

    public function __construct()
    {   
        $this->task = new Task();
    }

    public function addTask(string $task)
    {
        $this->task->addTask($task);
    }

    public function askForTasks(){
        return $this->task->askForTasks();
    }

    public function deleteTask(string $id){
        $this->task->deleteTask($id);
    }

}



?>
