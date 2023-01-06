<?php

namespace models;

// модель
class Articles extends Base
{
    public function getData()
    {
        //return $data = "test";
        return array('id' => 1, 'name' => 'Articles2');
    }
}
