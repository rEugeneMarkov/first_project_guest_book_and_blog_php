<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;
use models\Index as MIndex;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $get = $request->get;
        $pagination = new \Classes\Pagination('articles', 3, $get);
        $pagesInfo = $pagination->getPagesInfo();
        $data = MIndex::getTableContent('articles', $pagination->firstRow, $pagination->rowCount);
        return $this->contentToResponse(['data' => $data, 'pages' => $pagesInfo]);
    }
}
