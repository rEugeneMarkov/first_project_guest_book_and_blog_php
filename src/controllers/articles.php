<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Articles
{
    private $model;
    private $view;

    public function __construct(string $model)
    {
        $this->model = $model;
        $loader = new FilesystemLoader(paths:'templates');
        $this->view = new Environment($loader);
    }

    public function index()
    {
        $class = '\\models\\' . $this->model;
        $model = new $class();
        $data = $model->getData();
        $body = $this->view->render('articles.twig', $data);
        //$view = (SITE_PATH . 'view/view.php');
        //include($view);
        $content = $body;
        $response = new \classes\response($content);
        return $response;
    }
}
