<?php
namespace src\Model;

class Task
{
    public $that;
    public $dbh;
    private $polishCharacters = ['/ą/', '/ć/', '/ę/', '/ł/', '/ó/', '/ń/', '/ś/', '/ź/', '/ż/'];
    private $polishCharacterReplace = ['a', 'c', 'e', 'l', 'o', 'n', 's', 'z', 'z'];

    protected $counter = 0;

    public function __construct()
    {
        if(is_null($this->that)) {
            $this->counter++;
            $this->that = $this;
        }
        $this->createConnection();
        if (!$this->tableExist()) {
            $this->createTable();
        }
        return $this->that;
    }
    protected function tableExist(){
        $exists = $this->dbh->query("select 1 from tasks limit 1");
        if (!$exists) {
            error_log("Table doesnt exists.");
            return false;
        }

        return true;
    }

    public function addTask($task)
    {
        $task = $this->sanitizeTask($task);
        $task = $this->replacePolishCharacters($task);
        if ($task != false && ! (empty($task))) {
            $changedRows = $this->addToDB($task);
        }

        return $changedRows;
    }
    
    protected function addToDB($task){
        $task = mb_convert_encoding($task, 'utf8');
        $changedRows = $this->dbh->exec(
            "INSERT INTO TASKS (ID,TASK) VALUES(0,\"". $task . "\");"
        ); 
        if ($changedRows !== false) {

            return $changedRows;
        } else {
            error_log("Something happened while inserting into DB ");

            return false;
        }
    }

    protected function sanitizeTask($task): string 
    {
        $task =  filter_var(trim($task), FILTER_SANITIZE_STRING);
        if(strlen($task) !== 0){
            $_SESSION['hotpotat'] = 'kek';
        }
        return $task;

    }
    
    protected function createConnection()
    {
        $connection = $this->dbh = new \PDO("mysql:host=localhost;dbname=test", "root", "", []);
        if ($connection) {
            
        } else{
            error_log("Couldnt connect to databse");
        }
    }

    protected function createTable()
    {
        $created = $this->dbh->query("CREATE TABLE TASKS( ID INT NOT NULL AUTO_INCREMENT,
         TASK VARCHAR (200) NOT NULL, PRIMARY KEY (ID))");
        if($created){
            error_log("Created table") ;
        } else{
            error_log("Couldnt created table") ;
        }
    }

    public function askForTasks(){
        $query = 'select id,task from tasks';
        $sth = $this->dbh->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function deleteTask(string $id){
        $this->dbh->exec(
            'DELETE FROM TASKS WHERE ID =' . $id
        );
        $this->dbh->exec(
            'ALTER TABLE TASKS DROP ID'
        );
        $this->dbh->exec(
            'ALTER TABLE TASKS ADD ID INT UNSIGNED NOT NULL AUTO_INCREMENT FIRST,
             ADD PRIMARY KEY (ID);'
        );
    }

    protected function replacePolishCharacters(string $task): string 
    {

        return preg_replace($this->polishCharacters, $this->polishCharacterReplace, $task);
    }
}

?>
