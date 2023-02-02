<?php

namespace Classes;

use Classes\Comment;

class Comment
{
    public int $id;
    public int $pid;
    public int $aid;
    public string $comment;
    public string $date;
    /**
     * @var array <int, Comment> $children
     */
    public array $children;
}
