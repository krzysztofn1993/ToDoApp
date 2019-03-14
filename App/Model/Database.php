<?php 

namespace App\Model;

use App\Helpers\Error;


class Database {

    private $dbname = 'test';
    private $db = null;
    private $localhost = 'localhost';
    private $password = '';
    private $user = 'root';

    public function __construct()
    {       
        $this->connectToDB();
        $this->createUsersTableIfNotExists();
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

    private function connectToDB()
    {
        try {
            $this->selectDB();
            return true;
        } catch (\Throwable $th) {
            $this->createDB();
            $this->selectDB();
            return true;
        }
    }

    private function createDB()
    {
        $query = "CREATE DATABASE IF NOT EXISTS $this->dbname";
        try {
            $this->db = new \PDO("mysql:host=$this->localhost");
        } catch (\Throwable $th) {
            Error::fourOFour("Couldnt connect to host of DATABASES!");
        }
        try {
            $result = $this->db->exec($query);
        } catch (\Throwable $th) {
            Error::fourOFour("Couldnt create table");
        }
    }

    private function selectDB()
    {
        $this->db = new \PDO(
            "mysql:host=$this->localhost;dbname=$this->dbname", 
            $this->user, 
            $this->password);
    }

    private function createUsersTableIfNotExists()
    {
        $query = 'CREATE TABLE IF NOT EXISTS User(' .
            'ID INT NOT NULL AUTO_INCREMENT,' .
            'LOGIN VARCHAR(30)  NOT NULL,' .
            'PASSWORD VARCHAR(255) NOT NULL,' .
            'DATE DATE,' .
            'PRIMARY KEY (ID))';
            try {
                $this->db->exec($query);
            } catch (\Throwable $th) {
                Error::fourOFour("Couldnt create table");
            }
    }
}


?>