<?php

namespace App\Entity;

use Cycle\Annotated\Annotation as ORM;

#[ORM\Entity(table: 'symfony_post_tag')]
class PostTag
{
    #[ORM\Column(type: 'primary')]
    private ?int $id = null;
}
