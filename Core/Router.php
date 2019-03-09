<?php 

namespace Core;

use App\Helpers\Error;


class Router {

    protected $controller = 'App\Controller\Home';
    protected $method = 'index';

    public function goTo($url)
    {
        $url = trim($url);
        if ($url === "") {
            $this->callController();
        } else {
            try {
                $this->createControllerNamespace($url);
                $this->callController();
                $this->callMethod($url);
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

    protected function callController() : bool
    {
        if(class_exists($this->controller)) {
            $this->controller = new $this->controller;
            
            return true;
        } else {
            throw new Error('Controller for your given url doesnt exists', 404);
        }
    }
    
    protected function callMethod($url) : string
    {
        if (preg_match('/\/(\w+)\//', $url, $matches) === true ) {
            $this->method = $matches[1];
            call_user_func([$this->controller, $this->method]);
            
            return $this->method;
        } elseif (!isset($matches[1])) {
            call_user_func([$this->controller, $this->method]);
            
            return $this->method;
        } else {
            throw new Error('Method for your given url doesnt exists', 404);
        }
    }
}

?>
