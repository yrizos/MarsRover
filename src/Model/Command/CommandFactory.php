<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

use MarsRover\Exception\InvalidRoverCommandException;

class CommandFactory
{
    public static function getCommand(string $command): CommandInterface
    {
        $command = trim($command);
        $command = strtoupper($command);

        if ($command === 'M') {
            return new MoveForwardCommand();
        }

        if ($command === 'L') {
            return new RotateLeftCommand();
        }

        if ($command === 'R') {
            return new RotateRightCommand();
        }

        throw new InvalidRoverCommandException('Command ' . $command . ' is not acceptable.');
    }
}
