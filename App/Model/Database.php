<?php 

namespace App\Model;

class Database {

    private $dbname = 'test';
    private $handler = null;
    private $localhost = 'localhost';
    private $password = '';
    private $user = 'root';

    public function __construct()
    {
        $this->handler = new \PDO(
            "mysql:host=$this->localhost;dbname=$this->dbname", 
            $this->user, 
            $this->password);
    }

}


?>