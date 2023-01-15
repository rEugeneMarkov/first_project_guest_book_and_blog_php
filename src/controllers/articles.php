<?php

namespace Controllers;

class Articles extends Base
{
    public function index(\Classes\Request $request): \Classes\Response
    {
        $data = $this->modelObj->getData();
        return $this->helper(['data' => $data]);
    }
}
