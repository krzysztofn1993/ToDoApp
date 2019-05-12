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

    public static function getInstance(): Database
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
        $this->connectToDB();

        $sql = $this->db->prepare('SELECT * FROM Users WHERE LOGIN = :login');

        $sql->bindValue(':login', $login);
        $done = $sql->execute();
        $result = $sql->fetchAll();

        $this->db = null;

        return empty($result);
    }

    private function insertUserToDataBase(user $user): bool
    {
        $this->connectToDB();

        $sql = $this->db->prepare('INSERT INTO Users (USER_ID, LOGIN, PASSWORD, DATE) VALUES' .
            '(:user_id, :login, :hashed_password, :date)');

        $sql->bindValue(':user_id', 0);
        $sql->bindValue(':login', $user->getLogin());
        $sql->bindValue(':hashed_password', $user->getHashedPassword());
        $sql->bindValue(':date', $user->getDate());

        $result = $sql->execute();
        $this->db = null;

        return $result;
    }

    public function getUserTasks(string $user_id): ?array
    {
        $this->connectToDB();

        $sql = $this->db->prepare('SELECT TASK FROM TASKS WHERE USER_ID = :user_id and DONE <> 1');

        $sql->bindValue('user_id', $user_id);

        $sql->execute();
        $result = $sql->fetchAll();
        $this->db = null;

        return $result;
    }

    public function getUsersNewTask(string $user_id): ?array
    {
        $this->connectToDB();

        $sql = $this->db->prepare('SELECT TASK FROM TASKS WHERE USER_ID = :user_id ORDER BY CREATION_DATE DESC LIMIT 1');

        $sql->bindValue('user_id', $user_id);

        $sql->execute();
        $result = $sql->fetchAll();
        $this->db = null;

        return $result;
    }

    public function addTask(string $task, string $user_id): bool
    {
        if ($task !== null && $task !== '') {
            $this->connectToDB();

            $sql = $this->db->prepare('INSERT INTO Tasks(USER_ID, TASK, DONE, CREATION_DATE, MODIFICATION_DATE) VALUES' .
            '(:user_id, :task, :done, :creation_date, :modification_date)');

            $sql->bindValue(':user_id', $user_id);
            $sql->bindValue(':task', $task);
            $sql->bindValue(':done', 0);
            $sql->bindValue(':creation_date', date("Y-m-d H:i:s"));
            $sql->bindValue(':modification_date', date("Y-m-d H:i:s"));

            $result = $sql->execute();
            $this->db = null;

            return $result;
        }

        return false;
    }

    public function removeUsersTask(string $task, string $user_id): bool
    {
        $this->connectToDB();

        $sql = $this->db->prepare('UPDATE TASKS SET DONE = 1 WHERE TASK = :task and USER_ID = :user_id');

        $sql->bindValue(':task', $task);
        $sql->bindValue(':user_id', $user_id);

        $result = $sql->execute();
        $this->db = null;

        return $result;
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
        $this->connectToDB();

        $sql = $this->db->prepare('SELECT * FROM USERS WHERE LOGIN = :user_login');
        $sql->bindValue(':user_login', $user->getLogin());

        $sql->execute();
        $result = $sql->fetchAll();
        $this->db = null;
        
        return !empty($result);
    }

    private function createDB(): bool
    {       
        $sql = $this->db->prepare('CREATE DATABASE IF NOT EXISTS :dbName');
        $sql->bindValue(':dbName', $this->dbName);

        $this->db = new \PDO("mysql:host=$this->localhost");
        
        return $sql->execute();
    }
        
    private function selectDB(): void
    {
        $query = "mysql:host=$this->localhost;dbname=$this->dbName";
        $this->db = new \PDO(
            $query, 
            $this->dbUser, 
            $this->dbPassword);
    }
        
    private function createUsersTableIfNotExists(): bool
    {
        $this->connectToDB();

        $sql = $this->db->prepare(
            'CREATE TABLE IF NOT EXISTS Users(USER_ID INT NOT NULL AUTO_INCREMENT,' .
            'LOGIN VARCHAR(30)  NOT NULL, PASSWORD VARCHAR(255) NOT NULL,' .
            'DATE DATETIME, PRIMARY KEY (USER_ID));'
            );

        $result = $sql->execute();
        $this->db = null;

        return $result;
    }

    private function createTasksTableIfNotExists(): bool
    {
        $this->connectToDB();

        $sql = $this->db->prepare(
            'CREATE TABLE IF NOT EXISTS Tasks(' .
            'ID INT NOT NULL AUTO_INCREMENT,' .
            'USER_ID INT,' .
            'TASK VARCHAR(1000) NOT NULL,' .
            'DONE BOOLEAN,' .
            'CREATION_DATE DATETIME,' .
            'MODIFICATION_DATE DATETIME,' .
            'PRIMARY KEY (ID));'
            );

        $result = $sql->execute();
        $this->db = null;
        
        return $result;
    }

    public function getUserId(string $login): array
    {
        $this->connectToDB();

        $sql = $this->db->prepare('SELECT USER_ID FROM Users WHERE LOGIN = :user_login');
        $sql->bindValue(':user_login', $login);

        $sql->execute();

        return $sql->fetchAll();
    }
}
    
?>
