<?php declare (strict_types = 1);

namespace MarsRover\IO;

use MarsRover\Model\Rover;

class Output
{
    /**
     * @var string[]
     */
    private $output = [];

    /**
     * @return string
     */
    public function __toString(): string
    {
        return implode(PHP_EOL, $this->getOutput());
    }

    public function addRover(Rover $rover): self
    {
        $this->output[] = (string) $rover;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getOutput(): array
    {
        return $this->output;
    }
}
