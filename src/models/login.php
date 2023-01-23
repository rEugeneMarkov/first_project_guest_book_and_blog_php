<?php

namespace models;

// модель
class Login extends Base
{
    /**
     * @param array<string, string> $post
     * @return array<string, string>
     */
    public static function getDataFromPost(array $post): array
    {
        $data = [];
        $data['email'] = trim($post['email_login']);
        $data['pass'] = md5(trim($post['pass_login']));
        return $data;
    }
}
