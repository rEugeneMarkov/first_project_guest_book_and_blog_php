<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class AddArticle extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $message = [];
        $data = [];
        $errors = [];

        if ($this->user != null && $post != []) {
            $data = \models\AddArticle::getDataFromPost($post);
            $errors = \models\AddArticle::validate($data);
            if ($errors == []) {
                $data['user_id'] = $this->user->id;
                \models\AddArticle::addArticle($data);
                $message['success_add_article'] = "Вы успешно добавили статью!";
            }
        }
        return $this->contentToResponse(['data' => $data, 'message' => $message, 'errors' => $errors]);
    }
}
