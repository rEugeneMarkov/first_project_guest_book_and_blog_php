<?php

namespace Classes;

abstract class Db
{
    public static function getDb()
    {
        $db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->exec('SET CHARACTER SET utf8');
        return $db;
    }
}