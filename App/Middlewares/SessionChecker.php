<?php

namespace App\Middlewares\SessionChecker;

class SessionChecker
{

    private static $instance = null;
    private $minutes = 100;

    public static function getInstance(): SessionChecker
    {
        if (self::$instance === null) {
            self::$instance = new SessionChecker();
        }

        return self::$instance;
    }

    public function sessionCheck()
    {
        $this->setSession();
        $this->checkLastTime();
    }

    private function setSession()
    {
        if (isset($_SESSION['lastActionTime'])) {
            return;
        }
        $_SESSION['lastActionTime'] = time();
    }

    private function checkLastTime()
    {
        if (time() - $_SESSION['lastActionTime'] > 60 * $this->minutes) {
            session_unset();
        }
        $_SESSION['lastActionTime'] = time();
    }
}
