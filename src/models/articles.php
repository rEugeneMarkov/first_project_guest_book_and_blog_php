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
        $sql = 'SELECT `users`.`name`, `articles`. * FROM `users` 
            INNER JOIN `articles` ON `users`.`id`=`articles`.`uid` WHERE `articles`.`url` LIKE ?';
        $sth = $db->prepare($sql);
        //$sth = $db->prepare('SELECT * FROM `articles` WHERE `url` = ?');
        $sth->execute([$uri]);
        $data = $sth->fetchAll();
        return $data;
    }
}
