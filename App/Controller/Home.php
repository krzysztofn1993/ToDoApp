<?php

namespace App\Controller;

use App\Model\Database;


class Home {

    private $dataBase;

    public function __constructor(){
        $this->dataBase = Database::getInstance();
    }

    public function index()
    {
        require_once('../App/Views/content/Home.php');
    }

    public function createTask()
    {
        
        header('Location: /Projects/ToDoApp/public/');
    }
}

?>
