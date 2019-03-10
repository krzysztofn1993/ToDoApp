<?php 

namespace App\Model;

class Database {

    public static $localhost = "localhost";
    public static $password = "";
    public static $dbname = 'test';
    public static $user = "root";
    public static $handler = null;

    public function __construct()
    {
        $this->handler = new \PDO(
            "mysql:host=$this->localhost;dbname=$this->dbname", 
            $this->user, 
            $this->password);
    }
    

}


?>