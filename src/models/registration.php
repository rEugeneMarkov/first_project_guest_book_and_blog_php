<?php

namespace models;

// модель
class Registration extends User
{
    public function getData()
    {
        //return $data = "test";
        return array('id' => 1, 'name' => 'World');
    }
}