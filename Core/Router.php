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
                Error::fourOFour($e->getMessage());
            }
        }
    }

    protected function createControllerNamespace(string $url) : string
    {
        preg_match('/(\w+)\/?/', $url, $matches);
        $this->controller = preg_replace('/(\w+)$/', ucfirst(strtolower($matches[1])) , $this->controller);

        return $this->controller;
    }

    protected function checkIfControllerExists() : bool
    {
        if(class_exists($this->controller)) {

            return true;
        } else {
            throw new Error('Controller doesnt exist');
        }
    }
    
    protected function checkIfMethodExists($url) : bool
    {
        if (preg_match('/\/(\w+)\/?/', $url, $matches) == true ) {
            $this->method = $matches[1];
            if (method_exists($this->controller, $this->method)) {

                return true;
            } else {
                throw new Error("$this->method does not exist in $this->controller");
            }
        } elseif (!isset($matches[1])) {
            
            return true;
        } else {
            throw new Error("Bad url given: $url");
        }
    }
    
    protected function callPage()
    {
        $this->controller = new $this->controller;
        call_user_func([$this->controller, $this->method]);
    }

    protected function sanitizeURL(string $url) : string
    {
        $url = trim($url);
        return $url; 
    }
}

?>
