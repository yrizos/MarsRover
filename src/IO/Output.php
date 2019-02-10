<?php

namespace MarsRover\IO;

use MarsRover\Model\Rover;

class Output
{
    private $output = [];

    public function addRover(Rover $rover): Output
    {
        $this->output[] = (string)$rover;

        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function __toString()
    {
        return implode(PHP_EOL, $this->getOutput());
    }


}