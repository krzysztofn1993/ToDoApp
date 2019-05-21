<?php

namespace App\Controller;

use App\Model\Database;
use App\Model\User;

class Register
{

    private $user;
    private $dataBase;

    public function __construct()
    {
        $this->user = new User;
        $this->dataBase = Database::getInstance();
    }

    public function index()
    {
        require_once('../App/Views/content/Register.php');
    }

    public function check()
    {
        $this->user->setLogin($_POST['login']);
        $this->user->setPassword($_POST['password']);
        $this->user->setDate();
        unset($_POST);
        if ($this->dataBase->registerUser($this->user)) {
            header('Location: /Projects/ToDoApp/public/');
        } else {
            header('Location: /Projects/ToDoApp/public/register');
        }
    }
}
