<?php

namespace Classes;

use Classes\Comment;

class Comment
{
    public int $id;
    public int $parent_id;
    public int $article_id;
    public string $comment;
    public string $date;
    /**
     * @var array <int, Comment> $children
     */
    public array $children;
}
