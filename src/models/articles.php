<?php

namespace models;

// модель
class Articles extends Base
{
    /**
     * @return array {id: int, name: string}
     */
    public function getData(): array
    {
        return array('id' => 1, 'name' => 'Articles2');
    }

    /**
     * @return array<int|string, int|string>
     */
    public static function getArticleByUri(string $uri): ?array
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare('SELECT * FROM `articles` WHERE `url` = ?');
        $sth->execute([$uri]);
        $data = $sth->fetchAll();
        return $data;
    }
}
