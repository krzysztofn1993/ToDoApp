<?php

namespace App\Helpers;

class Error extends \Exception {

    public static function fourOFour()
    {
        echo "404";
        exit();
    }

}


?>
