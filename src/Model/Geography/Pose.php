<?php

namespace MarsRover\Model\Geography;

use MarsRover\Model\HasDirectionTrait;
use MarsRover\Model\HasPositionTrait;

class Pose
{

    use HasPositionTrait;
    use HasDirectionTrait;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->setPosition(new Position($x, $y))
            ->setDirection(new Direction($direction));
    }

}