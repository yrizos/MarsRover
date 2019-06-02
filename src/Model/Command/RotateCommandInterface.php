<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

interface RotateCommandInterface extends CommandInterface
{
    public function getDirection(): string;
}
