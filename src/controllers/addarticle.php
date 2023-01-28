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

        if ($post != []) {
            $data = \models\AddArticle::getDataFromPost($post);
            $message = \models\AddArticle::validate($data);
            if ($message == []) {
                if ($this->user != null) {
                    $data['username'] = $this->user->name;
                    $data['email'] = $this->user->email;
                }
                \models\AddArticle::addArticle($data['username'], $data['email'], $data['url'], $data['header'], $data['article']);
                $message['success_add_article'] = "Вы успешно добавили статью!";
                //header("Location: /articles");
            }
        }
        return $this->contentToResponse(['data' => $data, 'message' => $message]);
    }
}
