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
        $request = self::createRequestFromFactory($_GET, $_POST, [], $_COOKIE, $_FILES, $_SERVER);

        // if (str_starts_with($request->headers->get('CONTENT_TYPE', ''), 'application/x-www-form-urlencoded')
        //    && \in_array(strtoupper($request->server->get('REQUEST_METHOD', 'GET')), ['PUT', 'DELETE', 'PATCH'])
        // ) {
        //     parse_str($request->getContent(), $data);
        //     $request->request = new InputBag($data);
        // }
        return $request;
    }

    private static function createRequestFromFactory(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null): static
    {
        // if (self::$requestFactory) {
        //     $request = (self::$requestFactory)($query, $request, $attributes, $cookies, $files, $server, $content);

        //     if (!$request instanceof self) {
        //         throw new \LogicException('The Request factory must return an instance of Symfony\Component\HttpFoundation\Request.');
        //     }

        //     return $request;
        // }

        return new static($query, $request, $attributes, $cookies, $files, $server, $content);
    }
}
