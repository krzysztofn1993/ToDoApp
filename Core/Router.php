<?php

namespace Core;

use App\Helpers\Error;

class Router
{

    protected $controller = 'App\Controller\Home';
    protected $method = 'index';
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Router;
        }
        return self::$instance;
    }

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

    private function createControllerNamespace(string $url): string
    {
        preg_match('/(\w+)\/?/', $url, $matches);
        $this->controller = preg_replace('/(\w+)$/', ucfirst(strtolower($matches[1])), $this->controller);

        return $this->controller;
    }

    private function checkIfControllerExists(): bool
    {
        if (class_exists($this->controller)) {

            return true;
        } else {
            throw new Error('Controller doesnt exist');
        }
    }

    private function checkIfMethodExists($url): bool
    {
        if (preg_match('/\/(\w+)\/?/', $url, $matches) == true) {
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

    private function callPage()
    {
        $this->controller = new $this->controller;
        call_user_func([$this->controller, $this->method]);
    }

    private function sanitizeURL(string $url): string
    {
        $url = trim($url);
        preg_match('/^(.*)(\/)+$/', $url, $matches);
        if (isset($matches[2])) {
            header('Location: /Projects/ToDoApp/public/' . $matches[1]);
        }

        return $url;
    }
}
