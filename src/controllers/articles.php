<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Request;
use Classes\Response;

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
                return $this->contentToResponse(['data' => $article]);
            } else {
                return \Classes\Router::getErrorPage();
            }
        } else {

            $get = $request->get;
            $pagination = new \Classes\Pagination('articles', 10, $get);
            $pages = \Classes\Pagination::getDataPages($pagination->page, $pagination->strPag);
            $data = \models\Index::getTableContent('articles', $pagination->art, $pagination->kol);
            return $this->contentToResponse(['data' => $data, 'pages' => $pages]);
        }
    }
}
