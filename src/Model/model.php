<?php 

namespace src\Model;

class Model
{
    protected $dbh;


    public function __construct()
    {
        $this->createConnection();
        $this->createTable();
    }

    public function addTask($task)
    {
        $task = $this->sanitizeTask($task);
        if ($task != false && ! (empty($task))) {
            $this->dbh->exec("INSERT INTO TASKS (ID,TASK)
            VALUES(0,\"". $task . "\");"
            );
        }
    }

    protected function sanitizeTask($task) 
    {
        return filter_var(trim($task), FILTER_SANITIZE_STRING);
    }
    
    protected function createConnection()
    {
        try {
            $this->dbh = new \PDO("mysql:host=localhost;dbname=test",);
        } catch (Exception $e) {
            echo "Couldnt connect to databse. Message ".$e->getMessage();
        }
    }

    protected function createTable()
    {
        $this->dbh->exec("CREATE TABLE TASKS(
            ID   INT NOT NULL AUTO_INCREMENT,
            TASK VARCHAR (200) NOT NULL,   
            PRIMARY KEY (ID)
         );");
    }
}

?>
