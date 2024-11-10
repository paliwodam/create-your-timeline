<?php

namespace CreateYourTimeline;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method, $params = [])
    {

        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action, 'params' => $params];
    }

    public function get($route, $controller, $action, $params = [])
    {
        $this->addRoute($route, $controller, $action, "GET", $params);
    }

    public function post($route, $controller, $action, $params = [])
    {
        $this->addRoute($route, $controller, $action, "POST", $params);
    }
    
    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];


        if (array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];
            $paramNames = $this->routes[$method][$uri]['params'];
            $params = [];

            foreach ($paramNames as $paramName) {
                $params[] = $_GET[$paramName] ?? null; 
            }

            $controller = new $controller();
            $controller->$action(...$params);
        } else {
            throw new \Exception("No route found for URI: $uri");
        }
    }
}