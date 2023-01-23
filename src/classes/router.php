<?php

namespace Classes;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Response;
use Classes\Request;

class Router
{
    private string $uri;

    public function __construct()
    {
        //$this->uri = $uri;
    }

    public function start(Request $request): Response
    {
        $route = $this->uri;

        if ($route == '') {
            $route = 'index';
        }
        $file = SITE_PATH . 'controllers/' . $route . '.php';

        if (is_readable($file) == false) {
            $loader = new FilesystemLoader(paths:'templates');
            $view = new Environment($loader);
            $content = $view->render('error404.twig', []);
            $response = new \Classes\Response($content);
            return $response;
        }

        $controller = $route;
        $model = $route;
        $class = '\\controllers\\' . $controller;
        $controller = new $class($model);
        /** @var \Controllers\Base $controller */
        $content = $controller->index($request);
        return $content;
    }

    public function handle(Request $request): Response
    {
        $server = $request->server;
        $uri = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        if ($uri != false) {
            $uri = trim($uri, '/\\');
        } else {
            $uri = '';
        }
        $this->uri = $uri;
        $content = $this->start($request);
        return $content;
    }
}
