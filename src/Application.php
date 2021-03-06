<?php declare (strict_types = 1);

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
            if (! is_readable($input)) {
                throw new \InvalidArgumentException($input . ' is not readable.');
            }

            $input = file_get_contents($input);

            if (empty($input)) {
                throw new \InvalidArgumentException($input . ' is empty.');
            }
        }

        $input   = new Input($input);
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
