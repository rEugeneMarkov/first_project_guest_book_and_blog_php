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
    
}
