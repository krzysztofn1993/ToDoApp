<?php

use PHPUnit\Framework\TestCase;

use src\Controller\Controller;

class ControllerTest extends TestCase
{   
    protected $controller;

    public function setUp() : void
    {
        $this->controller = new Controller;
    }

    public function testTrueAssertstoTrue()
    {
        $this->assertTrue(true);
    }
}



?>
