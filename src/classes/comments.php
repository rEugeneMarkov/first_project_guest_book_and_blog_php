<?php

namespace Classes;

class Comments
{
    public int $commentsCount;

    /**
    * @return array <mixed>
    * Получаем все комментарии к определённой статье
    */
    public function getcommentsByArticleid(int $article): ?array
    {
        $db = \Classes\Db::getDb();
        //$sth = $db->prepare("SELECT * FROM `comments` WHERE aid = ?");
        $sql = 'SELECT `users`.`name`, `comments`. * FROM `users` 
            INNER JOIN `comments` ON `users`.`id`=`comments`.`uid` WHERE `comments`.`aid` LIKE ?';
        $sth = $db->prepare($sql);
        $sth->execute([$article]);

        $tree = [];
        $parents_arr = [];
        while ($data = $sth->fetchObject('\classes\Comment')) {
            $parents_arr[$data->pid][$data->id] = $data;
        }
        $treeElem = $parents_arr[0];
        $tree = self::generateElemTree($treeElem, $parents_arr);
        return $tree;
    }

    /**
     * @param array <int, Comment> $treeElem
     * @param array <int, array<int, Comment>> $parents_arr
     * @return array <int, Comment>
     */
    public function generateElemTree(array &$treeElem, array $parents_arr): array
    {
        foreach ($treeElem as $key => $item) {
            if (array_key_exists($key, $parents_arr)) {
                $treeElem[$key]->children = $parents_arr[$key];
                self::generateElemTree($treeElem[$key]->children, $parents_arr);
            }
        }
        return $treeElem;
    }
    /**
     * @return array <string,int|string>
     */
    public function getDataFromRequest(Request $request, \models\User $user): array
    {
        return [
            'pid'  => $request->get['id'],
            'aid' => $request->get['aid'],
            'uid' => $user->id,
            'comment'  => trim($request->post['comment'])
        ];
    }

    public function addComment(Request $request, \models\User $user): void
    {
        $data = $this->getDataFromRequest($request, $user);
        if ($data['comment'] != '') {
            $db = \Classes\Db::getDb();
            $sth = $db->prepare("INSERT INTO `comments` (`id`, `pid`, `aid`, `uid`, `comment`, `date`) 
            VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
            $sth->execute([$data['pid'], $data['aid'], $data['uid'], $data['comment']]);
        }
    }
}
