<?php

namespace Controllers;

class Index extends Base
{
    public function action()
    {
        $content = $this->view->render('index.twig', $this->getData());
        $response = new \classes\response($content);
        return $response;
    }

    public function index($request)
    {
        $post = $request->post;
        if(!empty($post)){
            \models\Index::addComment('Евгений Марков', $post['comment']);
        }
        //var_dump($post);

        $data = \models\Index::getDataFromTable('index');
        $content = $this->view->render('index.twig', array('data' => $data));
        //$content = $this->listAction();
        $response = new \classes\response($content);
        return $response;
    }
}
