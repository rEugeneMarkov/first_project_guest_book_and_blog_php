<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;
use models\Index as MIndex;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $message = [];

        if ($this->user != null && isset($post['add_comment'])) {
            $data = MIndex::getDataFromPost($post);
            $message = MIndex::validate($data);
            if ($message == []) {
                MIndex::addComment($this->user->name, $data['comment']);
                $message['success'] = "Запись успешно сохранена!";
            }
        }
        //тест комментариев
        //$comments = new \Classes\Comments();
        //$data = $comments->getcommentsByArticleid(1);
        //var_dump($data);
        //$tree = $comments->createTree($data);
        //var_dump($tree);
        //тест комментариев

        $get = $request->get;
        $pagination = new \Classes\Pagination('index', 3, $get);
        $pagesInfo = $pagination->getPagesInfo();
        $data = MIndex::getTableContent('index', $pagination->firstRow, $pagination->rowCount);
        return $this->contentToResponse(['data' => $data, 'message' => $message, 'pages' => $pagesInfo]);
    }
}
