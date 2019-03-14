<?php 

namespace App\Model;

use App\Helpers\Error;
use App\Model\User;

class Database {

    private $dbName = 'test';
    private $db = null;
    private $localhost = 'localhost';
    private $dbPassword = '';
    private $dbUser = 'root';
    private $user;
    private static $instance = null;

    private function __construct()
    {       
        $this->connectToDB();
        $this->createUsersTableIfNotExists();
        $this->user = new User;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database;
        }

        return self::$instance;
    }

    public function registerUser(user $user): bool
    {
        if ($this->canRegister($user->login)) {

            return $this->insertUserToDataBase($user);    
        } else {

            return false;
        }
    }

    private function canRegister(string $login): bool
    {
        $query = 'SELECT * FROM users WHERE user = $login';
        $result = $this->db->exec($query);

        return $result > 0? true : false;
    }

    private function insertUserToDataBase(user $user): bool
    {
        $query = "INSERT INTO USER VALUES" .
            "($user->login, $user->password, $user->date)";
        try {
            $this->db->exec($query);
        } catch (\Throwable $th) {
            if ($this->checkIfUserAdded($user)) {
                
            }
            
        }
        return true;
    }

    private function checkIfUserAdded(user $user)
    {
        $query = "SELECT * FROM USER WHERE login = $user->login OR date = $user->date" .
            " OR $password = $user->password";
    }

    private function connectToDB(): void
    {
        try {
            $this->selectDB();
        } catch (\Throwable $th) {
            $this->createDB();
            $this->selectDB();
        }
    }

    private function createDB(): void
    {
        $query = "CREATE DATABASE IF NOT EXISTS $this->dbName";
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
            "mysql:host=$this->localhost;dbname=$this->dbName", 
            $this->dbUser, 
            $this->dbPassword);
    }

    private function createUsersTableIfNotExists(): void
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