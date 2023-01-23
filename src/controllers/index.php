<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        if ($this->user != null && $post != []) {
            if (($post['add_comment'] == true)) {
                \models\Index::addComment($this->user->name, $post['comment']);
            }
        }

        $data = \models\Index::getDataFromTable('index');
        return $this->contentToResponse(['data' => $data]);
    }
}
