<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $post = $request->post;
        $message = [];

        if ($this->user != null && isset($post['add_comment'])) {
            $data = \models\Index::getDataFromPost($post);
            $message = \models\Index::validate($data);
            if ($message == []) {
                \models\Index::addComment($this->user->name, $data['comment']);
                $message['success'] = "Запись успешно сохранена!";
            }
        }
        //тест комментариев
        $comments = new \Classes\Comments();
        $data = $comments->getcommentsByArticleid(1);
        //var_dump($data);
        $tree = $comments->createTree($data);
        var_dump($tree);
        //тест комментариев

        $get = $request->get;
        $pagination = new \Classes\Pagination('index', 3, $get);
        $pages = \Classes\Pagination::getDataPages($pagination->page, $pagination->strPag);
        $data = \models\Index::getTableContent('index', $pagination->art, $pagination->kol);
        return $this->contentToResponse(['data' => $data, 'message' => $message, 'pages' => $pages]);
    }
}
