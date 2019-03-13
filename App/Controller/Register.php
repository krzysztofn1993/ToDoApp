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
        $this->dataBase = new Database;
    }

    public function index()
    {
        require_once('../App/Views/content/Register.php');
    }
    
    public function check()
    { 
        $this->dataBase->registerUser($_POST['login'], $_POST['password']);
    }

}

?>
