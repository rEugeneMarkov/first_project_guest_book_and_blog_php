<?php

namespace Controllers;

use Classes\Request;
use Classes\Response;

class Articles extends Base
{
    public function index(Request $request): Response
    {
        $data = $this->modelObj->getData();
        return $this->contentToResponse(['data' => $data]);
    }
}
