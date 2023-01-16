<?php

namespace Classes;

class Request
{
    public $server;
    public $get;
    public $post;

    public function __construct()
    {
        $this->server = $_SERVER;
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public static function createFromGlobals(): static
    {
        $request = self::createRequestFromFactory($_GET, $_POST, $_SERVER);
        return $request;
    }

    private static function createRequestFromFactory(array $query = [], array $request = [], array $server = []): static
    {
        return new static($query, $request, $server);
    }
}
