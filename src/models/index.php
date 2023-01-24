<?php

namespace models;

// модель
class Index extends Base
{
    /**
     * @param array<string, string> $post
     * @return array<string, string>
     */
    public static function getDataFromPost(array $post): array
    {
        $data = [];
        $data['comment'] = trim($post['comment']);
        return $data;
    }

    /**
     * @param array<string, string> $data
     * @return array<string, string>
     */
    public static function validate(array $data): array
    {
        $check = [];
        if (strlen($data['comment']) < 50) {
            $check['error'] = "Мин. длинна комментария 50 символов";
        }
        return $check;
    }
}
