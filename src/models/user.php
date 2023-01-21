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

    public static function getUserByEmailAndPass($email, $pass): object
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("SELECT * FROM `users` WHERE email = ? AND pass = ?");
        $sth->execute([$email, $pass]);
        $user = $sth->fetchObject('\Models\User');
        return $user;
    }

    public static function getUserByEmail($email): object
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("SELECT * FROM `users` WHERE email = ?");
        $sth->execute([$email]);
        $user = $sth->fetchObject('\Models\User');
        return $user;
    }
}
