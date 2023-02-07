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
        $headers = [];
        $status = 200;

        if (isset($post['login_button'])) {
            $data = \models\Login::getDataFromPost($post);
            $user = \models\User::getUserByEmailAndPass($data['email'], $data['pass']);
            if ($user != false) {
                $_SESSION['email'] = $data['email'] ;
                $headers = ['Location' => '/'];
                $status = 301;
                //$content = Response::redirect('/');
                //$response = new Response($content);
                //return $response;
            }
        }
        if (isset($post['clear_session'])) {
            unset($_SESSION['email']);
            $headers = ['Location' => '/login'];
            $status = 301;
            //$content = Response::redirect('/login');
            //$response = new Response($content);
            //return $response;
        }
        return $this->contentToResponse(['data' => $data], $status, $headers);
    }
}
