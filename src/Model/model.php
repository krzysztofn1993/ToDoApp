<?php 

namespace src\Model;

class Model
{
    protected $dbh;

    protected function tableExist(){
        try {
            $this->dbh->query("SELECT 1 FROM tasks LIMIT 1");
            return true;
        } catch (Exception $e) {
            echo "Table doesnt exists. Trying to create new one".$e->getMessage();
            $this->createTable();
        }
    }

    public function __construct()
    {
        $this->createConnection();
        $this->createTable();
    }

    public function addTask($task)
    {
        $this->tableExist();
        $task = $this->sanitizeTask($task);
        if ($task != false && ! (empty($task))) {
            $changedRows = $this->addToDB($task);
        }
    }
    
    protected function addToDB($task){
        try {
            $changedRows = $this->dbh->exec(
                "INSERT INTO TASKS (ID,TASK) VALUES(0,\"". $task . "\");"
            );
            return $changedRows;   
        } catch (\Throwable $e) {
            echo "Something happened while inserting into DB". $e->getMessage();
            return false;
        }
    }

    protected function sanitizeTask($task) 
    {
        return filter_var(trim($task), FILTER_SANITIZE_STRING);
    }
    
    protected function createConnection()
    {
        try {
            $this->dbh = new \PDO("mysql:host=localhost;dbname=test");
        } catch (Exception $e) {
            echo "Couldnt connect to databse. Message ".$e->getMessage();
        }
    }

    protected function createTable()
    {
        try {
            $this->dbh->exec("CREATE TABLE TASKS(
                ID   INT NOT NULL AUTO_INCREMENT,
                TASK VARCHAR (200) NOT NULL,   
                PRIMARY KEY (ID));"
                );
            return true;
        } catch (\Throwable $e) {
            echo "Couldn't create table".$e->getMessage();
            return false;
        }
    }
}

?>
