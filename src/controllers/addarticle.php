<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class AddArticle extends Base
{
    public function index(Request $request): Response
    {
        $server = $request->server;
        $uri = \Classes\Router::getUriFromServer($server);
        if (isset($uri[1])) {
            return \Classes\Router::getErrorPage();
        } else {
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
                    $array = [
                        $data['username'],
                        $data['email'],
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
}
