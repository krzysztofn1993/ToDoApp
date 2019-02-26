<?php 

namespace src\Controller;
use src\Model\Model;



class Controller
{
    protected $model;

    public function __construct()
    {   
        $this->model = new Model();
    }

    public function addTask($task)
    {
        $this->model->addTask($task);
    }

    public function askForTasks(){
        return $this->model->askForTasks();
    }

}



?>
