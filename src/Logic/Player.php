<?php

namespace Idle\Logic;

use Idle\Logic\Scalars\ID;
use Idle\Logic\Scalars\Name;

class Player
{

    private readonly ID $id;

    private readonly Name $name;

    public function __construct(ID $id, Name $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ID
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }
}
