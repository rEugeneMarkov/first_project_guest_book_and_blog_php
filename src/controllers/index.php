<?php

namespace Controllers;

class Index extends Base
{
    public function index(\Classes\Request $request): \Classes\Response
    {
        $post = $request->post;

        if (!empty($post)) {
            \Models\Index::addComment('Евгений Марков', $post['comment']);
        }

        $data = \Models\Index::getDataFromTable('index');
        return $this->helper(['data' => $data]);
    }
}
