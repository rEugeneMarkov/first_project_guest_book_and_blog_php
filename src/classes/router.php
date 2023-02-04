<?php

namespace Classes;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Response;
use Classes\Request;

class Router
{
    /**
     * @var array<int,int|string>
     */
    private array $uri;

    public function __construct()
    {
    }

    public function start(Request $request): Response
    {
        $route = $this->uri;
        $controller = $route[0];

        if ($controller == '') {
            $controller = 'index';
        }
        $file = SITE_PATH . 'controllers/' . $controller . '.php';

        if (is_readable($file) == false) {
            return self::getErrorPage();
        } elseif (isset($route[1]) && $route[0] != 'articles') {
            return self::getErrorPage();
        } elseif (isset($route[2])) {
            return self::getErrorPage();
        } else {
            $class = '\\controllers\\' . $controller;
            $controller = new $class();
            /** @var \Controllers\Base $controller */
            $content = $controller->index($request);
            return $content;
        }
    }

    public function handle(Request $request): Response
    {
        $server = $request->server;
        $uri = self::getUriFromServer($server);
        $this->uri = $uri;
        $content = $this->start($request);
        return $content;
    }

    /**
     * @param array<string, string> $server
     * @return array<int, string>
     */

    public static function getUriFromServer(array $server): array
    {
        $uri = parse_url($server['REQUEST_URI'], PHP_URL_PATH);
        if ($uri != false) {
            $uri = trim($uri, '/\\');
            $uri = explode("/", $uri);
        } else {
            $uri = [];
        }
        return $uri;
    }
    public static function getErrorPage(): Response
    {
        $loader = new FilesystemLoader(paths:'templates');
        $view = new Environment($loader);
        $content = $view->render('error404.twig', []);
        $response = new \Classes\Response($content);
        return $response;
    }
}
