<?php

namespace App\Middlewares\SessionChecker;

class SessionChecker {

    private static $instance = null;
    private $lastAction = null;

    private function _construct()
    {

    }

    public static function getInstance(): SessionChecker
    {
        if(self::$instance === null) {
            self::$instance = new SessionChecker();
        }

        return self::$instance;
    }

    public function sessionCheck(){
        if(wasActive()) {
            $this->sessionUpdate();
        } else {

        }
    }
    
    public function sessionUpdate()
    {
        if(isset($_SESSION['time'])) {
            $this->lastAction = time();
            return;
        }
        $_SESSION['time'] = time();
        $this->lastAction = time();
    }

    public function wasActive()
    {
        if(time() - $this->lastAction > 60*15) {
            
        }
    }
}


?>