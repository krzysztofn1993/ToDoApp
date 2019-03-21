<?php

namespace App\Helpers;

class Error extends \Exception {

    public static function fourOFour($message = '')
    {
        echo "404. " . $message;
        exit();
    }

}


?>
