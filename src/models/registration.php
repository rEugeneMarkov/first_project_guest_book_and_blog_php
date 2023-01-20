<?php

namespace models;

// модель
class Registration extends Base
{
    public static function getDataFromPost(array $post): array
    {
        $data['name'] = trim($post['name_reg']);
        $data['email'] = trim($post['email_reg']);
        $data['pass'] = trim($post['pass_reg']);
        return $data;
    }

    public static function validate(array $data): array
    {
        if (strlen($data['name']) <= 1) { // проверка имени
                $error['e_username'] = "Введите корректное имя";
        } elseif (strlen($data['email']) < 7) { //проверка почты
                $error['e_email'] = "Введите корректную почту";
        } elseif (\Models\User::isEmailExists($data['email'])) { // проверка почты на наличие в базе
                $error['e_email'] = "Такой пользователь уже зарегистрирован";
        } elseif (strlen($data['pass']) < 6) {
                $error['e_pass'] = "Минимальная длинна пароля 6 символов";
        } else {
            $error = [];
        }
        return $error;
    }
}
