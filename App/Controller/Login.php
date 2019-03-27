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

        if ($this->dataBase->login($this->user)) {
            $this->setUserLoggedSession($this->user);
            header('Location: /Projects/ToDoApp/public/');
        }
        else {
            $this->setUserBadLoginSession();
            header('Location: /Projects/ToDoApp/public/');
        }
    }
    
    private function setUserLoggedSession(user $user)
    {
        $_SESSION['lastActionTime'] = time();
        $_SESSION['user'] = $user->getLogin();
        $_SESSION['pw'] = $user->getHashedPassword();
    }
    
    private function setUserBadLoginSession()
    {
        if (isset($_SERVER['PHP_AUTH_USER']) &&  isset($_SERVER['PHP_AUTH_PW'])) {
            unset($_SERVER['PHP_AUTH_USER']);
            unset($_SERVER['PHP_AUTH_PW']);
        }
    }
}

?>
