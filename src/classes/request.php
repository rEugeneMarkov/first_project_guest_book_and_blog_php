<?php

namespace Classes;

class Request
{
    /**
     * @var array<string, string>
     */

    public array $server;

    /**
     * @var array<string, string>
     */

    public array $get;

    /**
     * @var array<string, string>
     */

    public array $post;
    /**
     * @param array<string, string> $get
     * @param array<string, string> $post
     * @param array<string, string> $server
     */
    final public function __construct(array $get = [], array $post = [], array $server = [])
    {
        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
    }

    public static function createFromGlobals(): static
    {
        $request = self::createRequestFromFactory($_GET, $_POST, $_SERVER);
        return $request;
    }

    /**
     * @param array<string, string> $get
     * @param array<string, string> $post
     * @param array<string, string> $server
     * @return static
     */

    private static function createRequestFromFactory(array $get = [], array $post = [], array $server = []): static
    {
        return new static($get, $post, $server);
    }
}
