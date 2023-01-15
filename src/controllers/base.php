<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Base
{
    protected string $model;
    protected object $view;
    protected array $data;
    protected object $modelObj;

    public function __construct(string $model)
    {
        $this->model = $model;
        $loader = new FilesystemLoader(paths:'templates');
        $this->view = new Environment($loader);
        $class = '\\models\\' . $this->model;
        $model = new $class();
        $this->modelObj = $model;
    }

    public function helper(array $data): \Classes\Response
    {
        $content = $this->view->render($this->model . '.twig', $data);
        $response = new \Classes\Response($content);
        return $response;
    }
}
