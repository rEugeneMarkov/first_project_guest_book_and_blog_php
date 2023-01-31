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
        $sth = $db->prepare("SELECT * FROM `comments` WHERE aid = ?");
        $sth->execute([$article]);
        $data = $sth->fetchAll();
        $this->commentsCount = count($data);
        if ($data != null) {
            $tree = $this->createTree($data);
        } else {
            $tree = [];
        }
        return $tree;
    }

    /**
    * @param array <int|string,mixed> $data
    * @return array <int,mixed>
    */
    public function createTree(array $data): array
    {
        $parents_arr = [];

        foreach ($data as $key => $item) {
            /**
             * @var array <string,int|string> $item
             */
            $parents_arr[$item['pid']][$item['id']] = $item;
        }
        $treeElem = $parents_arr[0];
        self::generateElemTree($treeElem, $parents_arr);

        return $treeElem;
    }
    /**
    * @param array <int|string,mixed> $parents_arr
    * @param array <int,mixed> $treeElem
    */
    public function generateElemTree(array &$treeElem, array $parents_arr): void
    {
        foreach ($treeElem as $key => $item) {
            /**
             * @var array <string,int|string> $item
             */
            if (!isset($item['children'])) {
                $treeElem[$key]['children'] = [];
            }
            if (array_key_exists($key, $parents_arr)) {
                $treeElem[$key]['children'] = $parents_arr[$key];
                self::generateElemTree($treeElem[$key]['children'], $parents_arr);
            }
        }
    }

    /**
     * @return array <string,int|string>
     */
    public function getDataFromRequest(Request $request): array
    {
        $post = $request->post;
        $get = $request->get;

        return [
            'pid'  => trim($get['id']),
            'aid' => trim($get['aid']),
            'comment'  => trim($post['comment'])
        ];
    }

    public function addComment(Request $request): void
    {
        $data = $this->getDataFromRequest($request);
        if ($data['comment'] != '') {
            $db = \Classes\Db::getDb();
            $sth = $db->prepare("INSERT INTO `comments` (`id`, `pid`, `aid`, `comment`, `date`) 
            VALUES (NULL, ?, ?, ?, CURRENT_TIMESTAMP)");
            $sth->execute([$data['pid'], $data['aid'], $data['comment']]);
        }
    }
}
