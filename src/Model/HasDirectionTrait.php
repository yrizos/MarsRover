<?php declare (strict_types = 1);

namespace MarsRover\Model;

use MarsRover\Model\Geography\Direction;

trait HasDirectionTrait
{
    private $direction;

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    protected function setDirection(Direction $direction)
    {
        $this->direction = $direction;

        return $this;
    }
}
