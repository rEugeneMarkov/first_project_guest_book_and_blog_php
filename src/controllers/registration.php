<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Registration extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $error = [];
        $data = [];

        if (!empty($post)) {
            $data = \Models\Registration::getDataFromPost($post);
            $error = \Models\Registration::validate($data);
            if (!$error) {
                \Models\User::addUser($data['name'], $data['email'], $data['pass']);
                $error['success'] = "Вы успешно зарегистрировались!";
            }
        }
        return $this->contentToResponse(['data' => $data, 'error' => $error]);
    }
}
