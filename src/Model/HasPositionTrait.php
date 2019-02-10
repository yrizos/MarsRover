<?php

namespace MarsRover\Model;

use MarsRover\Model\Geography\Position;

trait HasPositionTrait
{

    private $position;

    public function getPosition(): Position
    {
        return $this->position;
    }

    protected function setPosition(Position $position)
    {
        $this->position = $position;

        return $this;
    }

}