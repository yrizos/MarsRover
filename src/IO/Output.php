<?php declare (strict_types = 1);

namespace MarsRover\IO;

use MarsRover\Model\Rover;

class Output
{
    private $output = [];

    public function __toString()
    {
        return implode(PHP_EOL, $this->getOutput());
    }

    public function addRover(Rover $rover): self
    {
        $this->output[] = (string) $rover;

        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }
}
