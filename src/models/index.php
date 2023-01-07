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
    public function getDataFromSql()
    {
        $data = $this->db->query('SELECT * FROM `index`');
        $data = $data->fetchAll();
        return $data;
    }
}
