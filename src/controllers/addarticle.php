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

        if ($this->user != null && $post != []) {
            $data = \models\AddArticle::getDataFromPost($post);
            $message = \models\AddArticle::validate($data);
            if ($message == []) {
                $data['uid'] = $this->user->id;
                $array = [
                    $data['uid'],
                    $data['url'],
                    $data['header'],
                    $data['article']
                ];
                \models\AddArticle::addArticle($array);
                $message['success_add_article'] = "Вы успешно добавили статью!";
            }
        }
        return $this->contentToResponse(['data' => $data, 'message' => $message]);
    }
}
