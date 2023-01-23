<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;

        if ($post != []) {
            \models\Index::addComment('Евгений Марков', $post['comment']);
        }

        $data = \models\Index::getDataFromTable('articles');
        return $this->contentToResponse(['data' => $data]);
    }
}
