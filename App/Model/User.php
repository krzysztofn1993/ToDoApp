<?php 

namespace App\Model;

class User {

    private $id;
    private $login;
    private $password;
    private $date;

    public function getUser($login = null) 
    {
    }

    public function getID(): string 
    {
        return $this->id;
    }

    public function setID(int $id)
    {
        $this->id = $id;
    }
    public function getLogin(): string 
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }
    public function getPassword(): string 
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    public function getDate(): string 
    {
        return $this->date;
    }

    public function setDate()
    {
        $this->date = date("Y-m-d H:i:s");
    }
}

?>