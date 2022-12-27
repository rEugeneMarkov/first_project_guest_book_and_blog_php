<?php

namespace Classes;

class Router
{
    private $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    public function start()
    {
        $route = $this->uri;
        $route = trim($route, '/\\');

        if (empty($route)) {
            $route = 'index';
        }

        $action = $route;
        $controller = $route;
        $model = $route;
        $class = '\\controllers\\' . $controller;
        $controller = new $class($model);
        $controller->$action();
    }
}
