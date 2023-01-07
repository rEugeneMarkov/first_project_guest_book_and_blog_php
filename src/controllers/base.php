<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Base
{
    protected $model;
    protected $view;
    protected $data;
    protected $modelObj;

    public function __construct(string $model)
    {
        $this->model = $model;
        $loader = new FilesystemLoader(paths:'templates');
        $this->view = new Environment($loader);
        $class = '\\models\\' . $this->model;
        $model = new $class();
        $this->modelObj = $model;
        $data = $model->getData();
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }
}