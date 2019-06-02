<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

class RotateLeftCommand implements RotateCommandInterface
{
    public function getDirection(): string
    {
        return 'L';
    }
}
