<?php

namespace Controllers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Classes\Request;
use Classes\Response;
use models\Articles as MArticles;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $server = $request->server;
        $post = $request->post;
        $uri = \Classes\Router::getUriFromServer($server);

        if (isset($uri[1])) {
            $article = MArticles::getArticleByUri($uri[1]);

            if ($article != null) {
                $this->template = 'article.twig';

                $Articleid = $article[0]['id'];
                $Articleid = (int) $Articleid;
                $comments = new \Classes\Comments();

                if ($this->user != null && isset($post['add_comment_to_article'])) {
                    $comments->addComment($request, $this->user);
                }
                $tree = $comments->getcommentsByArticleid($Articleid);

                return $this->contentToResponse(['data' => $article, 'comments' => $tree]);
            } else {
                return \Classes\Router::getErrorPage();
            }
        } else {
            $get = $request->get;
            $pagination = new \Classes\Pagination('articles', 10, $get);
            $pagesInfo = $pagination->getPagesInfo();
            $data = MArticles::getTableContent('articles', $pagination->firstRow, $pagination->rowCount);
            return $this->contentToResponse(['data' => $data, 'pages' => $pagesInfo]);
        }
    }
}
