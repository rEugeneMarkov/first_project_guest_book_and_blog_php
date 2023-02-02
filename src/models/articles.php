<?php

namespace models;

// модель
class Articles extends Base
{
    /**
     * @return array <int|string, array<int|string, int|string>>
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
