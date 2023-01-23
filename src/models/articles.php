<?php

namespace models;

// модель
class Articles extends Base
{
    /**
     * @return array{id: int, name: string}
     */
    public function getData(): array
    {
        return array('id' => 1, 'name' => 'Articles2');
    }
}
