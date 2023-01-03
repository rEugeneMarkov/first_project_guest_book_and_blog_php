<?php

namespace Controllers;

class Index
{
    private $model;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $class = '\\models\\' . $this->model;
        $model = new $class();
        $data = $model->getData();
        $view = (SITE_PATH . 'view/view.php');
        //include($view);
        $content = 'Hello world';
        $response = new \classes\response($content);
        return $response;
    }
}
