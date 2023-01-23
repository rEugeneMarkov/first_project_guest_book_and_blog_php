<?php

namespace Classes;

class Db
{
    public static ?\PDO $db = null;

    public static function getDb(): \PDO
    {
        if (self::$db === null) {
            self::$db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$db->exec('SET CHARACTER SET utf8');
        }
        return self::$db;
    }
}
