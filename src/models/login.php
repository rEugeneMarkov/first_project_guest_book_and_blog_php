<?php

namespace models;

// модель
class Login extends Base
{
    public static function getDataFromPost(array $post): array
    {
        $data['email'] = trim($post['email_login']);
        $data['pass'] = md5(trim($post['pass_login']));
        return $data;
    }
}
