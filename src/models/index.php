<?php

namespace models;

// модель
class Index extends Base
{
    public function getData()
    {
        //return $data = "test";
        return array('id' => 1, 'name' => 'World');
    }
    public static function getDataFromTable(string $table)
    {
        $db = \Classes\DB::getDb();
        $data = $db->query('SELECT * FROM `' . $table . '`');
        $data = $data->fetchAll();
        return $data;
    }
}
