<?php

namespace models;

// модель
class User extends Base
{
    public static function addUser(string $name, string $email, string $pass): void
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
        VALUES (NULL, ?, MD5(?), ?, CURRENT_TIMESTAMP)");
        $sth->execute([$name, $pass, $email]);
    }

    public static function isEmailExists(string $email): bool
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("SELECT `email` FROM `users` WHERE email = ?");
        $sth->execute([$email]);
        $row = $sth->rowCount();
        return $row > 0;
    }
}
