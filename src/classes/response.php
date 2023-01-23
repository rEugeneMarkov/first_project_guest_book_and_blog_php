<?php

namespace Classes;

class Response
{
    protected string $content;


    public function __construct(string $content = '')
    {
        $this->setContent($content);
    }

    public function __toString(): string
    {
        return $this->getContent();
    }

    /**
     * @return $this
     */

    public function setContent(?string $content): static
    {
        $this->content = $content ?? '';

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return $this
     */

    public function sendContent(): static
    {
        echo $this->content;

        return $this;
    }

    /**
     * @return $this
     */

    public function send(): static
    {
        $this->sendContent();

        return $this;
    }
}
