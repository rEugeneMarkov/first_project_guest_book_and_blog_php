<?php

namespace Controllers;

class Registration extends Base
{
    public function index(\Classes\Request $request): \Classes\Response
    {
        $post = $request->post;
        if (!empty($post)) {
            $data['name'] = trim($post['name_reg']);
            $data['email'] = trim($post['email_reg']);
            $data['pass'] = trim($post['pass_reg']);

            if (strlen($data['name']) <= 1) { // проверка имени
                $error['e_username'] = "Введите корректное имя";
            } elseif (strlen($data['email']) < 7) { //проверка почты
                $error['e_email'] = "Введите корректную почту";
            } elseif (\Models\User::isEmailExists($data['email'])) { // проверка почты на наличие в базе
                $error['e_email'] = "Такой пользователь уже зарегистрирован";
            } elseif (strlen($data['pass']) < 6) {
                $error['e_pass'] = "Минимальная длинна пароля 6 символов";
            } else {
                \Models\User::addUser($data['name'], $data['email'], $data['pass']);
                $error['success'] = "Вы успешно зарегистрировались!";
            }
        } else {
            $error = [];
            $data = [];
        }
        return $this->helper(['data' => $data, 'error' => $error]);
    }
}
