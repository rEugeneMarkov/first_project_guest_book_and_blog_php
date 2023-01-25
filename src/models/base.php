<?php

namespace models;

// модель
abstract class Base
{
    public function __construct()
    {
    }

    /**
     * @return array<string|int, string>
     */
    public static function getDataFromTable(string $table): array
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT * FROM `' . $table . '`ORDER BY `id` DESC');
        $sth->execute();
        $data = $sth->fetchAll();
        //var_dump($data);
        return $data;
    }

    public static function addComment(string $name, string $comment): void
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('INSERT INTO `index` (`id`, `name`, `date`, `content`) 
        VALUES (NULL, ?, CURRENT_TIMESTAMP, ?)');
        $sth->execute([$name, $comment]);
    }

    public static function getTableCount(string $table): int
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT COUNT(*) FROM `' . $table . '`');
        $sth->execute();
        $count = $sth->fetchAll();
        $total = $count[0];
        return $total[0];
    }

    /**
     * @return array<string|int, string>
     */

    public static function getTableContent(string $table, int $art, int $kol): array
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT * FROM `' . $table . '` ORDER BY `id` DESC LIMIT ' . $art . ',' . $kol . '');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }
}
