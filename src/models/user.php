<?php

namespace models;

// модель
class User extends Base
{
    public static function addUser(string $name, string $email, string $pass)
    {
        $db = \Classes\Db::getDb();
        //$sql = "INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
           // VALUES (NULL, '?', MD5('?'), '?', CURRENT_TIMESTAMP)"
        //$db->prepare("INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
        //VALUES (NULL, ?, MD5(?), ?, CURRENT_TIMESTAMP)");
        $db->execute([$name, $pass, $email]);
        $db->query("INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
         VALUES (NULL, '$name', MD5('$pass'), '$email', CURRENT_TIMESTAMP)");
    }

    public static function isEmailExists(string $email): bool
    {
        $db = \Classes\Db::getDb();
        $result = $db->query("SELECT `email` FROM `users` WHERE email = '" . $email . "'");
        $row = $result->rowCount();
        return $row > 0;
    }
}
