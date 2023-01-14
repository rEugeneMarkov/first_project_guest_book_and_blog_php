<?php

namespace models;

// модель
class User extends Base
{
    public static function addUser(string $name, string $email, string $pass)
    {
        $db = \Classes\DB::getDb();
        $db->query("INSERT INTO `users` (`id`, `name`, `pass`, `email`, `date`) 
        VALUES (NULL, '$name', MD5('$pass'), '$email', CURRENT_TIMESTAMP)");
        
    }
    
    public static function isEmailExists(string $email): bool
    {
        $db = \Classes\DB::getDb();
        $result = $db->query("SELECT `email` FROM `users` WHERE email = '" . $email . "'");
        $row = $result->rowCount();
        return $row > 0;
    }
}