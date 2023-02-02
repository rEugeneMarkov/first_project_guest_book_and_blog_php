<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;
use models\Index as MIndex;

class Index extends Base
{
    public function index(Request $request): Response
    {
        $server = $request->server;
        $uri = \Classes\Router::getUriFromServer($server);
        if (isset($uri[1])) {
            return \Classes\Router::getErrorPage();
        } else {
            $post = $request->post;
            $message = [];

            if ($this->user != null && isset($post['add_comment'])) {
                $data = MIndex::getDataFromPost($post);
                $message = MIndex::validate($data);
                if ($message == []) {
                    MIndex::addComment($this->user->id, $data['comment']);
                    $message['success'] = "Запись успешно сохранена!";
                }
            }

            $get = $request->get;
            $pagination = new \Classes\Pagination('index', 3, $get);
            $pagesInfo = $pagination->getPagesInfo();
            $data = MIndex::getTableContent('index', $pagination->firstRow, $pagination->rowCount);
            return $this->contentToResponse(['data' => $data, 'message' => $message, 'pages' => $pagesInfo]);
        }
    }
}
