<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $get = $request->get;
        $pagination = new \Classes\Pagination('articles', 3, $get);
        $pages = \Classes\Pagination::getDataPages($pagination->page, $pagination->strPag);
        $data = \models\Index::getTableContent('articles', $pagination->art, $pagination->kol);
        //$data = \models\Index::getDataFromTable('articles');
        return $this->contentToResponse(['data' => $data, 'pages' => $pages]);
    }
}
