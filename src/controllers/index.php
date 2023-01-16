<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;

        if (!empty($post)) {
            \Models\Index::addComment('Евгений Марков', $post['comment']);
        }

        $data = \Models\Index::getDataFromTable('index');
        return $this->contentToResponse(['data' => $data]);
    }
}
