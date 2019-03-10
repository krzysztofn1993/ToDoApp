<?php 

namespace Core;

use App\Helpers\Error;


class Router {

    protected $controller = 'App\Controller\Home';
    protected $method = 'index';

    public function goTo($url)
    {
        $url = $this->sanitizeURL($url);
        if ($url === "") {
            $this->callPage();
        } else {
            try {
                $this->createControllerNamespace($url);
                $this->checkIfControllerExists();
                $this->checkIfMethodExists($url);
                $this->callPage();
            } catch (\Exception $e) {
                
            }
        }
    }

    protected function createControllerNamespace(string $url) : string
    {
        preg_match('/(\w+)\/?/', $url, $matches);
        $this->controller = preg_replace('/(\w+)$/', $matches[1] , $this->controller);

        return $this->controller;
    }

    protected function checkIfControllerExists() : bool
    {
        if(class_exists($this->controller)) {

            return true;
        } else {
            Error::FourOFour();
        }
    }
    
    protected function checkIfMethodExists($url) : bool
    {
        if (preg_match('/\/(\w+)\/?/', $url, $matches) == true ) {
            $this->method = $matches[1];
            if (method_exists($this->controller, $this->method)) {

                return true;
            } else {
                Error::FourOFour();
            }
        } elseif (!isset($matches[1])) {
            
            return true;
        } else {
            Error::FourOFour();
        }
    }
    
    protected function callPage()
    {
        call_user_func([$this->controller, $this->method]);
    }

    protected function sanitizeURL(string $url) : string
    {
        /* Add better sanitization
        */
        $url = trim($url);
        return $url; 
    }
}

?>
