<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Request;
use Classes\Response;

class Base
{
    protected string $model;
    protected Environment $view;
    protected array $data;
    protected \models\Base $modelObj;

    public function __construct(string $model)
    {
        $this->model = $model;
        $loader = new FilesystemLoader(paths:'templates');
        $this->view = new Environment($loader);
        $class = '\\models\\' . $this->model;
        $model = new $class();
        $this->modelObj = $model;
    }

    public function contentToResponse(array $data): Response
    {
        $content = $this->view->render($this->model . '.twig', $data);
        $response = new Response($content);
        return $response;
    }
}
