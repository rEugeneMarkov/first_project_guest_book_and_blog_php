<?php

namespace Controllers;

class Articles extends Base
{
    public function index()
    {
        $content = $this->view->render('articles.twig', $this->getData());
        $response = new \classes\response($content);
        return $response;
    }
}
