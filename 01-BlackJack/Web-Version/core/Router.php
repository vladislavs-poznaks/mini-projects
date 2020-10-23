<?php

namespace Core;

use Exception;

class Router
{
    private $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($type, $uri)
    {
        if (array_key_exists($uri, $this->routes[$type])) {

            return $this->callAction(
                ...explode('@', $this->routes[$type][$uri])
            );

        } else {
            throw (new Exception('URI not defined'));
        }
    }

    protected function callAction($controller, $action)
    {
        return (new $controller())->$action();
    }
}