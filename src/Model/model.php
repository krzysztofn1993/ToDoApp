<?php 

namespace src\Model;

class Model
{
    protected $dbh;


    public function __construct()
    {
        $this->createConnection();
    }

    public function addTask($task)
    {
        $task = $this->sanitizeTask($task);
        if($task != false && ! (empty($task))){

        }
    }

    protected function sanitizeTask($task) 
    {
        $task = trim($task);
        return filter_var($task, FILTER_SANITIZE_STRING);
    }
    
    protected function createConnection()
    {
        try {
            $this->dbh = new \PDO("mysql:host=localhost;dbname=test",);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>
