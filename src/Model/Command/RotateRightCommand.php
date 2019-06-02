<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

class RotateRightCommand implements RotateCommandInterface
{
    public function getDirection(): string
    {
        return 'R';
    }
}
