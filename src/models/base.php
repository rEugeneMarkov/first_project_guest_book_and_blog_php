<?php

namespace models;

// модель
class Base
{
    protected $db;

    Public function __construct()
    {
        $db = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->exec('SET CHARACTER SET utf8');
        $this->db = $db;
    }
}