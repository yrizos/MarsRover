<?php declare (strict_types = 1);

namespace MarsRover\Model;

use MarsRover\Model\Geography\Direction;

trait HasDirectionTrait
{
    /**
     * @var Direction
     */
    private $direction;

    public function getDirection(): Direction
    {
        return $this->direction;
    }

    protected function setDirection(Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }
}
