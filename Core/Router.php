<?php 

namespace Core;

use App\Helpers\Erorr;


class Router {

    protected $controller = 'App\Controller\Home';
    protected $method = 'index';
    protected $error;

    public function __construc(){
        $this->error = new Erorr;
    }

    public function goTo($url)
    {
        $url = trim($url);
        if ($url === "") {
            $this->callController();
        } else {
            $this->createControllerNamespace($url);
            $this->getMethodToCall($url);
            $this->callController();
        }
    }

    protected function createControllerNamespace(string $name) : string
    {
        $this->controller = preg_replace('/\w+$/', $name, $this->controller);

        return $this->controller;
    }

    protected function callController() : bool
    {
        if(class_exists($this->controller) && method_exists($this->controller, $this->method)) {
            $this->controller = new $this->controller;
            call_user_func([$this->controller, $this->method]);

            return true;
        } else {
            $code = 404;
            $message = 'Controller for your given url doesnt exists';
            $this->error->notFound($code, $message)
            return false;
        }
    }
    
    protected function getMethodToCall($url) : string
    {
        if (preg_match('/\/(\w+)\//', $url, $matches) === true) {
            $this->method = $matches[1];

            return $this->method;
        } else {
            echo "404 method not found";

            return $this->method;
        }
    }
}

?>
