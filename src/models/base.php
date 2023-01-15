<?php

namespace models;

// модель
class Base
{
    protected $db;

    public function __construct()
    {
    }

    public static function getDataFromTable(string $table): array
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT * FROM `' . $table . '`ORDER BY `id` DESC');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }

    public static function addComment(string $name, string $comment)
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('INSERT INTO `index` (`id`, `name`, `date`, `content`) 
        VALUES (NULL, ?, CURRENT_TIMESTAMP, ?)');
        $sth->execute([$name, $comment]);
    }

    public static function getTableCount(string $table): int
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT COUNT(*) FROM `?`');
        $sth->execute([$table]);
        $row = $sth->fetch_row();
        $total = $row[0];
        return $total;
    }
}
