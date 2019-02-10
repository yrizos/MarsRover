<?php

namespace MarsRover\Model\Command;

interface RotateCommandInterface extends CommandInterface
{

    public function getDirection(): string;

}