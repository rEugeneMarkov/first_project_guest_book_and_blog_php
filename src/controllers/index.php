<?php

namespace Controllers;

class Index extends Base
{
    public function index()
    {
        $content = $this->view->render('index.twig', $this->getData());
        $response = new \classes\response($content);
        return $response;
    }
}
