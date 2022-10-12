<?php

namespace App\Repository;

use App\Entity\Comment;
use Cycle\SymfonyBundle\Repository\CycleServiceRepository;

class CommentRepository extends CycleServiceRepository
{
    public static function getEntityClass(): string
    {
        return Comment::class;
    }
}
