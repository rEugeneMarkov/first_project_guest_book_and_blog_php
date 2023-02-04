<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Registration extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $message = [];
        $data = [];

        if ($post != []) {
            $data = \models\Registration::getDataFromPost($post);
            $message = \models\Registration::validate($data);
            if ($message == []) {
                \models\User::addUser($data['name'], $data['email'], $data['pass']);
                $message['success'] = "Вы успешно зарегистрировались!";
            }
        }
        return $this->contentToResponse(['data' => $data, 'message' => $message]);
    }
}
