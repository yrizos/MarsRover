<?php

namespace MarsRover\Model\Command;

class RotateRightCommand implements RotateCommandInterface
{

    public function getDirection(): string
    {
        return 'R';
    }

}