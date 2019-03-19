<?php 

namespace App\Model;

class User {

    private $id;
    private $login;
    private $hashed_password;
    private $password;
    private $date;

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
        $this->setHashedPassword($password);
    }
    public function getHashedPassword(): string 
    {
        return $this->hashed_password;
    }

    public function setHashedPassword(string $password)
    {
        $this->hashed_password = password_hash($password, PASSWORD_DEFAULT);
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