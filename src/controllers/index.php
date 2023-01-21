<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        if (!empty($post['add_comment'])) {
            \Models\Index::addComment($this->user->name, $post['comment']);
        }

        $data = \models\Index::getDataFromTable('index');
        return $this->contentToResponse(['data' => $data]);
    }
}
