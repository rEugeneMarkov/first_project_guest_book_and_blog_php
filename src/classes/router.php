<?php

namespace Classes;

class Router
{
    private $uri;

    public function __construct()
    {
        //$this->uri = $uri;
    }

    public function start()
    {
        $route = $this->uri;
        $route = trim($route, '/\\');

        if (empty($route)) {
            $route = 'index';
        }
        $file = SITE_PATH . 'controllers/' . $route . '.php';

        if (is_readable($file) == false) {
            die('404 Not Found');
        }

        $controller = $route;
        $model = $route;
        $class = '\\controllers\\' . $controller;
        $controller = new $class($model);
        $content = $controller->index();
        return $content;
    }

    public function handle($request)
    {
        $server = $request->server;
        $uri = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = $uri;
        $content = $this->start();
        return $content;
    }
}
