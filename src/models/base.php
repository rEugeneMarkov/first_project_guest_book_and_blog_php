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
        $db = \Classes\DB::getDb();
        $data = $db->query('SELECT * FROM `' . $table . '`ORDER BY `id` DESC');
        $data = $data->fetchAll();
        return $data;
    }

    public static function addComment(string $name, string $comment)
    {
        $db = \Classes\DB::getDb();
        $db->query("INSERT INTO `index` (`id`, `name`, `date`, `content`) 
        VALUES (NULL, '$name', CURRENT_TIMESTAMP, '$comment')");
    }

    public static function getTableCount(string $table): int
    {
        $db = \Classes\DB::getDb();
        $res = $db->query("SELECT COUNT(*) FROM `$table`");
        $row = $res->fetch_row();
        $total = $row[0];
        return $total;
    }
}
