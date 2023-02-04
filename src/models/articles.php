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
            INNER JOIN `articles` ON `users`.`id`=`articles`.`uid` WHERE `articles`.`url` = ?';
        $sth = $db->prepare($sql);
        $sth->execute([$uri]);
        $data = $sth->fetchAll();
        return $data;
    }
}
