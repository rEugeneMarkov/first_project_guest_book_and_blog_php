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

    public static function addComment(int $id, string $comment): void
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('INSERT INTO `index` (`id`, `user_id`, `date`, `content`) 
        VALUES (NULL, ?, CURRENT_TIMESTAMP, ?)');
        $sth->execute([$id, $comment]);
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
        $sql = 'SELECT `' . $table . '` . * , `users`.`name` FROM `' . $table . '` 
            INNER JOIN `users` ON `' . $table . '`.`user_id`=`users`.`id` 
            ORDER BY `' . $table . '`.`id` DESC LIMIT ' . $art . ',' . $kol . '';
        $sth = $db->prepare($sql);
        //$sth = $db->prepare('SELECT * FROM `' . $table . '` ORDER BY `id` DESC LIMIT ' . $art . ',' . $kol . '');
        $sth->execute();
        $data = $sth->fetchAll();
        return $data;
    }
}
