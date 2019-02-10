<?php

namespace MarsRover;

use MarsRover\IO\Input;
use MarsRover\IO\Output;
use MarsRover\Model\Geography\Plateau;
use MarsRover\Model\Rover;

class Application
{
    public static function run(string $input): Output
    {
        if (is_file($input)) {
            $input = file_get_contents($input);
        }

        $input = new Input($input);

        $plateau = new Plateau($input->getPlateau()->getPosition());
        $rovers  = $input->getRovers();
        $output  = new Output();

        foreach ($rovers as $item) {
            $rover = new Rover($plateau, $item->getPosition(), $item->getDirection());
            $rover->executeMultiple($item->getCommands());

            $output->addRover($rover);
        }

        return $output;
    }
}