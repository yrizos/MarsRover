<?php

namespace MarsRover\IO;

class Input
{

    private $plateau;
    private $rovers = [];

    public function __construct(string $input)
    {
        $input = trim($input);
        $input = explode(PHP_EOL, $input);
        $input = array_map('trim', $input);

        $this->plateau = new PlateauInput(array_shift($input));

        foreach ($input as $index => $line) {
            if ($index % 2 == 1) {
                continue;
            }

            $this->rovers[] = new RoverInput(
                $line,
                isset($input[$index + 1]) ? $input[$index + 1] : ''
            );
        }
    }

    public function getPlateau(): PlateauInput
    {
        return $this->plateau;
    }

    public function getRovers(): array
    {
        return $this->rovers;
    }
}