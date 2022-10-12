<?php

namespace App\Entity;

use Cycle\Annotated\Annotation as ORM;

#[ORM\Entity()]
class PostTag
{
    #[ORM\Column(type: 'primary')]
    private ?int $id = null;
}
