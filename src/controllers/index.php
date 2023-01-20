<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        //var_dump($_SESSION['email']);
        if (!empty($post)) {
            \Models\Index::addComment($this->user->name, $post['comment']);
        }
        $data = \Models\Index::getDataFromTable('index');
        return $this->contentToResponse(['data' => $data]);
    }
}
