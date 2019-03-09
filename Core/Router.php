<?php 

namespace Core;

use App\Controller\Home;

class Router {

    protected $controller = 'Home';
    protected $method = 'index';
    
    public function __construct()
    {

    }

    public function goTo($url)
    {
        $url = trim($url);
        if ($url === "") {
            $home = new Home;
            $home->index();
        }

    }

    protected function checkController(string $url)
    {
    }

}

?>