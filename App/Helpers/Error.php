<?php

namespace App\Helpers;

class Error extends \Exception {

    public function __construct($message, $code = 0, Exception $previous = null) 
    {
        parent::__construct($message, $code, $previous);
        $this->goToErrorPage($message, $code);
    }

    protected function goToErrorPage($message = '', $code = null)
    {
        if ($message !== '' & $code !== null) {
            echo $message . '<br>';
            echo "Maestro di Errori numero " . $code . '<br>';
        } elseif ($message !== '' & $code === null) {
            echo $message . '<br>';
        } elseif ($message === '' & $code !== null) {
            echo "Maestro di Errori numero " . $code . '<br>';
        } else {
            echo "Something went wrong";
        }
    }

}


?>
