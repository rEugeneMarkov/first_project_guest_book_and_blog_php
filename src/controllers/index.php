<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $message = [];

        if ($this->user != null && isset($post['add_comment'])) {
            $data = \models\Index::getDataFromPost($post);
            $message = \models\Index::validate($data);
            if ($message == []) {
                \models\Index::addComment($this->user->name, $data['comment']);
                $message['success'] = "Запись успешно сохранена!";
            }
        }

        $data = \models\Index::getDataFromTable('index');
        return $this->contentToResponse(['data' => $data, 'message' => $message]);
    }
}
