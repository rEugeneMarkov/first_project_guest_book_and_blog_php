<?php

namespace Classes;

class Comments
{
    /**
    * @return array <mixed>
    * Получаем все комментарии к определённой статье
    */
    public function getcommentsByArticleid(int $article): ?array
    {
        $db = \Classes\Db::getDb();
        $sql = 'SELECT `users`.`name`, `comments`. * FROM `users` 
            INNER JOIN `comments` ON `users`.`id`=`comments`.`user_id` WHERE `comments`.`article_id` = ?';
        $sth = $db->prepare($sql);
        $sth->execute([$article]);
        $tree = [];

        if (($data = $sth->rowCount()) > 0) {
            $parents_arr = [];
            while ($data = $sth->fetchObject(Comment::class)) {
                $parents_arr[$data->parent_id][$data->id] = $data;
            }
            $treeElem = $parents_arr[0];

            $tree = self::generateElemTree($treeElem, $parents_arr);
        }
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
            'parent_id'  => $request->get['id'],
            'article_id' => $request->get['aid'],
            'user_id' => $user->id,
            'comment'  => trim($request->post['comment'])
        ];
    }

    public function addComment(Request $request, \models\User $user): void
    {
        $data = $this->getDataFromRequest($request, $user);
        if ($data['comment'] != '') {
            $db = \Classes\Db::getDb();
            $sth = $db->prepare("INSERT INTO `comments` (`id`, `parent_id`, `article_id`, `user_id`, `comment`, `date`) 
            VALUES (NULL, :parent_id, :article_id, :user_id, :comment, CURRENT_TIMESTAMP)");
            $sth->execute($data);
        }
    }
}
