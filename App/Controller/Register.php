<?php 

namespace App\Controller;

use App\Model\User;
use App\Model\Database;


class Register {

    private $user;
    private $dataBase;

    public function __construct()
    {
        $this->user = new User;
        $this->dataBase = Database::getInstance();
    }

    public function index()
    {
        require_once('../App/Views/content/Register.php');
    }
    
    public function check()
    { 
        $this->user->login = $_POST['login'];
        $this->user->password = $_POST['password'];
        $this->user->date = date("Y-m-d H:i:s");
        unset($_POST);
        $this->dataBase->registerUser($this->user);
    }

}

?>
