<?php 

namespace App\Model;

class Database {

    private $dbname = 'test';
    private $db = null;
    private $localhost = 'localhost';
    private $password = '';
    private $user = 'root';

    public function __construct()
    {
        $this->db = new \PDO(
            "mysql:host=$this->localhost;dbname=$this->dbname", 
            $this->user, 
            $this->password);
    }

    public function registerUser(string $login,string $password) 
    {
        $this->canRegister($login);
    }

    private function canRegister(string $login): int
    {
        $query = "SELECT * FROM users where user = \"$login\"";
        $result = $this->db->exec($query);
        return $result;
    }
}


?>