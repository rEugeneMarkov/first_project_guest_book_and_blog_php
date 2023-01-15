<?php

namespace Classes;

class Response
{
    protected $content;


    public function __construct(?string $content = '')
    {
        $this->setContent($content);
    }

    public function __toString(): string
    {
        return $this->getContent();
    }

    public function setContent(string $content)
    {
        $this->content = $content ?? '';

        return $this;
    }

    public function getContent(): string|false
    {
        return $this->content;
    }

    public function sendContent(): static
    {
        echo $this->content;

        return $this;
    }

    public function send()
    {
        $this->sendContent();

        return $this;
    }
}
