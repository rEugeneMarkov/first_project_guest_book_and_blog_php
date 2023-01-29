<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Request;
use Classes\Response;
use models\Index as MIndex;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $server = $request->server;
        $uri = \Classes\Router::getUriFromServer($server);
        if (isset($uri[1])) {
            $article = \models\Articles::getArticleByUri($uri[1]);
            if ($article != null) {
                $this->model = 'article';
                //-----------------
                $comments = new \Classes\Comments();
                $data = $comments->getcommentsByArticleid(1);
                $tree = $comments->createTree($data);
                //-----------------
                return $this->contentToResponse(['data' => $article, 'tree' => $tree]);
            } else {
                return \Classes\Router::getErrorPage();
            }
        } else {
            $get = $request->get;
            $pagination = new \Classes\Pagination('articles', 10, $get);
            $pagesInfo = $pagination->getPagesInfo();
            $data = MIndex::getTableContent('articles', $pagination->firstRow, $pagination->rowCount);
            return $this->contentToResponse(['data' => $data, 'pages' => $pagesInfo]);
        }
    }
}
