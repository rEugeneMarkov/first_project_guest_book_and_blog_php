<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Login extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $data = [];

        if (isset($post['login_button'])) {
            $data = \Models\Login::getDataFromPost($post);
            if ($user = \Models\User::getUserByEmailAndPass($data['email'], $data['pass'])) {
                $_SESSION['email'] = $user->email ;
                header("Location: /");
            }
        }
        if (isset($post['clear_session'])) {
            unset($_SESSION['email']);
            header("Location: /login");
        }
        return $this->contentToResponse(['data' => $data]);
    }
}
