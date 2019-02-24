<?php 

namespace src\Controller;

use src\Model\Model;

use PHPUnit\Framework\Exception;


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

}



?>
