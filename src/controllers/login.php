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
            $data = \models\Login::getDataFromPost($post);
            $user = \models\User::getUserByEmailAndPass($data['email'], $data['pass']);
            if ($user != false) {
                $_SESSION['email'] = $data['email'] ;
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
