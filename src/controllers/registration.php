<?php

namespace Controllers;

class Registration extends Base
{
    public function action()
    {
        $content = $this->view->render('index.twig', $this->getData());
        $response = new \classes\response($content);
        return $response;
    }

    public function index($request)
    {
        $post = $request->post;
        if(!empty($post)){
            $data['name'] = htmlspecialchars(trim($post['name_reg']));
            $data['email'] = htmlspecialchars(trim($post['email_reg']));
            $data['pass'] = htmlspecialchars(trim($post['pass_reg']));

            if (strlen($data['name']) <= 1) { // проверка имени
                $data['e_username'] = "Введите корректное имя";
            } elseif (strlen($data['email']) < 7) { //проверка почты
                $data['e_email'] = "Введите корректную почту";
            } elseif (\Models\User::isEmailExists($data['email'])) { // проверка почты на наличие в базе
                $data['e_email'] = "Такой пользователь уже зарегистрирован";
            } elseif (strlen($data['pass']) < 6) {
                $data['e_pass'] = "Минимальная длинна пароля 6 символов";
            } else {
                \models\User::addUser($data['name'], $data['email'], $data['pass']);
                $data['success'] = "Вы успешно зарегистрировались!";
            }
        } else {
            $data = []; 
        }

        $content = $this->view->render('registration.twig', array('data' => $data));
        $response = new \classes\response($content);
        return $response;
    }
}
