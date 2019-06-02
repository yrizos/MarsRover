<?php declare (strict_types = 1);

namespace MarsRover\Model;

use MarsRover\Model\Geography\Position;

trait HasPositionTrait
{
    /**
     * @var Position
     */
    private $position;

    public function getPosition(): Position
    {
        return $this->position;
    }

    protected function setPosition(Position $position): self
    {
        $this->position = $position;

        return $this;
    }
}
