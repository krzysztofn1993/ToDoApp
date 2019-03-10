<?php

namespace App\Helpers;

class Error extends \Exception {

    public static function FourOFour()
    {
        echo "404";
        exit();
    }

}


?>
