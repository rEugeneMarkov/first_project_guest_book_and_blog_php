<?php

namespace Classes;
 
class Comments
{
    /**
    * @return array <mixed>
    */
    public function getcommentsByArticleid(int $article): array
    {
        $db = \Classes\Db::getDb();
        $sth = $db->prepare("SELECT * FROM `comments` WHERE aid = ?");
        $sth->execute([$article]);
        $data = $sth->fetchAll();
        return $data;
    }

    /**
    * @param array <mixed> $data
    * @return array <mixed>
    */
    public function createTree(array $data): array
    {
        $parents_arr = [];

	    foreach($data as $key=>$item) {
		    $parents_arr[$item['pid']][$item['id']] = $item;
	    }
	    $treeElem = $parents_arr[0];
	    self::generateElemTree($treeElem,$parents_arr);
	
	    return $treeElem;
    }

    /**
     * @param array <mixed> $parents_arr
     * @param array <mixed> $treeElem
     */
    public function generateElemTree(&$treeElem,$parents_arr): void
    {
        foreach($treeElem as $key=>$item) {
            if(!isset($item['children'])) {
                $treeElem[$key]['children'] = [];
            }
            if(array_key_exists($key,$parents_arr)) {
                $treeElem[$key]['children'] = $parents_arr[$key];
                self::generateElemTree($treeElem[$key]['children'],$parents_arr);
            }
        }
    }
}