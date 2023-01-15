<?php

namespace Classes;

class Db
{
    private static $db;

    public static function getDb(): \PDO
    {
        if (self::$db === null) {
            self::$db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
            self::$db->exec('SET CHARACTER SET utf8');
        }
        return self::$db;
    }
}
