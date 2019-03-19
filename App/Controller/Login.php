<?php

namespace App\Controller;

use App\Model\Database;
use App\Model\User;


class Login {

    private $user;
    private $dataBase;

    public function __construct()
    {
        $this->user = new User;
        $this->dataBase = Database::getInstance();
    }

    public function check()
    {
        $this->user->setLogin($_POST['login']);
        $this->user->setPassword($_POST['password']);
        $this->user->setDate();
        unset($_POST);
        if ($this->dataBase->login($this->user)) {
            $this->setUserLoggedSessionAndCookies();
            header('Location: /Projects/ToDoApp/public/');
        }
        else {
            $this->setUserBadLogin-SessionAndCookies();
            header('Location: /Projects/ToDoApp/public/');
        }
    }



}


?>