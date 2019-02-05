<?php 

namespace src\Controller;

use src\Model\Model;

use PHPUnit\Framework\Exception;


class Controller
{
    protected $model;

    public function __construct()
    {   
        echo "Controller construct<br>";
        $this->model = new Model();
    }

    public function addTask($task)
    {
        $this->model->addTask($task);
    }

}



?>
