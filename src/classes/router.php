<?php

namespace Classes;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Router
{
    private $uri;

    public function __construct()
    {
        //$this->uri = $uri;
    }

    public function start($request)
    {
        $route = $this->uri;
        $route = trim($route, '/\\');

        if (empty($route)) {
            $route = 'index';
        }
        $file = SITE_PATH . 'controllers/' . $route . '.php';

        if (is_readable($file) == false) {
            $loader = new FilesystemLoader(paths:'templates');
            $view = new Environment($loader);
            $content = $view->render('error404.twig', []);
            $response = new \Classes\Response($content);
            return $response;
            die;
            //die('404 Not Found');
        }

        $controller = $route;
        $model = $route;
        $class = '\\controllers\\' . $controller;
        $controller = new $class($model);
        $content = $controller->index($request);
        return $content;
    }

    public function handle($request)
    {
        $server = $request->server;
        $uri = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = $uri;
        $content = $this->start($request);
        return $content;
    }
}
