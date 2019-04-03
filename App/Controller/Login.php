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
        $this->setUserCredentials();

        if ($this->dataBase->login($this->user)) {
            $this->user->setID($_POST['login']);
            $this->setUserLoggedSession();
            header('Location: /Projects/ToDoApp/public/');
        }
        else {
            $this->setUserBadLoginSession();
            header('Location: /Projects/ToDoApp/public/');
        }
    }
    
    private function setUserLoggedSession()
    {
        $_SESSION['lastActionTime'] = time();
        $_SESSION['U_ID'] = $this->user->getID();
    }
    
    private function setUserBadLoginSession()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) &&  isset($_SERVER['PHP_AUTH_PW'])) {
            unset($_SERVER['PHP_AUTH_USER']);
            unset($_SERVER['PHP_AUTH_PW']);
        }
    }

    private function setUserCredentials()
    {
        $this->user->setLogin($_POST['login']);
        $this->user->setPassword($_POST['password']);
        $this->user->setDate();
    }
}

?>
