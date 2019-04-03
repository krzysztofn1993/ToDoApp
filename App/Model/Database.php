<?php 

namespace App\Model;

use App\Helpers\Error;
use App\Model\User;

class Database {

    private $dbName = 'test';
    private $db = null;
    private $localhost = 'localhost';
    private $dbPassword = '';
    private $dbUser = '';
    private static $instance = null;

    private function __construct()
    {       
        $this->connectToDB();
        $this->createUsersTableIfNotExists();
        $this->createTasksTableIfNotExists();
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
        if ($this->canRegister($user->getLogin())) {
            return $this->insertUserToDataBase($user);    
        } else {
            return false;
        }
    }

    private function canRegister(string $login): bool
    {
        $query = 'SELECT * FROM Users WHERE LOGIN = \'' . $login . '\'';
        $result = $this->selectFromDaabase($query, "Something happened when checking if can register User");
        
        return empty($result) ? true : false;
    }

    private function insertUserToDataBase(user $user): bool
    {
        $query = 'INSERT INTO Users (USER_ID, LOGIN, PASSWORD, DATE) VALUES' .
            '(' . 0 . ', ' .
            '\'' . $user->getlogin() . '\', ' . 
            '\'' . $user->getHashedPassword() . '\', ' .
            '\'' . $user->getDate() .  '\')';
        try {
            $result = $this->queryDB($query);
            $this->checkIfUserAdded($user);      

            return $result;
        } catch (\Throwable $th) {
            if ($this->checkIfUserAdded($user)) {
                $this->rollBackAddedUser($user);
            }
        }

        return true;
    }

    public function getUserTasks(string $id): ?array
    {
        $sql = 'SELECT TASK FROM TASKS WHERE USER_ID =\'' . $id . '\';';
        
        return  $this->selectFromDatabase($sql, 'Error while searching for user tasks');
    }

    public function addTask(string $task, string $id)
    {
        // $task = $this->sanitizeTask($task);
        if ($task !== null && $task !== '') {
            $sql = '
            INSERT INTO Tasks(USER_ID, TASK, DONE, CREATION_DATE, MODIFICATION_DATE) VALUES' .
            '(' . $id . 
            ',\' ' . $task . '\'' .
            ', ' . 0 . 
            ',\' ' . date("Y-m-d H:i:s") . '\''. 
            ',\' ' . date("Y-m-d H:i:s") . '\''. 
            ')';

            try{
                $result = $this->queryDB($sql);
            } catch(\Throwable $th) {

            }
        }
    }

    private function checkIfUserAdded(user $user)
    {
        $query = 'SELECT * FROM Users WHERE login = "' . $user->getLogin() . '"';
        return $this->selectFromDatabase($query, "Error while checking if User was added");
    }
    
    private function rollBackAddedUser(user $user)
    {
        $query = "DELETE FROM Users WHERE login = $user->login";
        $this->queryDB($query, "Error while deleting badly added user");
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

    public function login(user $user): bool
    {
        $query =  'SELECT * FROM USERS WHERE LOGIN =\'' . $user->getLogin() . '\'';
        if (!empty($this->selectFromDatabase($query))) {
            return true;
        }
        return false;
    }

    private function createDB(): void
    {
        $query = "CREATE DATABASE IF NOT EXISTS $this->dbName";
        try {
            $this->db = new \PDO("mysql:host=$this->localhost");
        } catch (\Throwable $th) {
            Error::fourOFour("Couldnt connect to host of DATABASES!");
        }
        $this->queryDB($query, "Couldnt create table");
    }
    
    public function queryDB(string $query, string $msg = null)
    {
        $this->connectToDB();
        try {
            $result = $this->db->exec($query);
            $this->db = null;
            return $result;
        } catch (\Throwable $th) {
            Error::fourOFour($msg);
        }
    }
    
    private function selectDB()
    {
        $query = "mysql:host=$this->localhost;dbname=$this->dbName";
        $this->db = new \PDO(
            $query, 
            $this->dbUser, 
            $this->dbPassword);
            return true;
    }
        
    private function createUsersTableIfNotExists(): void
    {
        $query = 'CREATE TABLE IF NOT EXISTS Users(' .
        'USER_ID INT NOT NULL AUTO_INCREMENT,' .
        'LOGIN VARCHAR(30)  NOT NULL,' .
        'PASSWORD VARCHAR(255) NOT NULL,' .
        'DATE DATETIME,' .
        'PRIMARY KEY (USER_ID))';
        try {
            $result = $this->queryDB($query);
        } catch (\Throwable $th) {
            Error::fourOFour("Couldnt create users table");
        }
    }

    private function createTasksTableIfNotExists()
    {
        $query = 'CREATE TABLE IF NOT EXISTS Tasks(' .
        'ID INT NOT NULL AUTO_INCREMENT,' .
        'USER_ID INT,' .
        'TASK VARCHAR(1000) NOT NULL,' .
        'DONE BOOLEAN,' .
        'CREATION_DATE DATETIME,' .
        'MODIFICATION_DATE DATETIME,' .
        'PRIMARY KEY (ID))';
        try {
            $result = $this->queryDB($query);
        } catch (\Throwable $th) {
            Error::fourOFour("Couldnt create tasks table");
        }
    }
    
    public function selectFromDatabase (string $query, string $msg = null)
    {
        $this->connectToDB();
        try {
            $result = $this->db->query($query);
            $result = $result->fetchAll();
            $this->db = null;
            return $result;
        } catch (\Throwable $th) {
            Error::fourOFour($msg);
        }
    }
}
    
?>
