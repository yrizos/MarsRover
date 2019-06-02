<?php declare (strict_types = 1);

namespace MarsRover\IO;

use MarsRover\Model\Command\CommandCollection;
use MarsRover\Model\Command\CommandFactory;
use MarsRover\Model\Geography\Direction;
use MarsRover\Model\Geography\Pose;
use MarsRover\Model\Geography\Position;

class RoverInput
{
    private $commands;

    private $pose;

    public function __construct(
        string $pose,
        string $commands
    ) {
        $this->pose     = self::parsePose($pose);
        $this->commands = self::parseCommands($commands);
    }

    public function getCommands(): CommandCollection
    {
        return $this->commands;
    }

    public function getDirection(): Direction
    {
        return $this->getPose()->getDirection();
    }

    public function getPose(): Pose
    {
        return $this->pose;
    }

    public function getPosition(): Position
    {
        return $this->getPose()->getPosition();
    }

    public static function parseCommands(string $input): CommandCollection
    {
        $input = str_split($input);
        $input = array_map('trim', $input);
        $input = array_filter($input);

        $commands = new CommandCollection();

        foreach ($input as $command) {
            $commands->addCommand(CommandFactory::getCommand($command));
        }

        return $commands;
    }

    public static function parsePose(string $input): Pose
    {
        $input   = trim($input);
        $pattern = '/([0-9]{0,15}) ([0-9]{0,15}) ([nswe])/i';

        if (! preg_match($pattern, $input, $matches, PREG_OFFSET_CAPTURE)) {
            throw new InvalidInputException($input . ' is not valid pose input.');
        }

        return new Pose(
            (int) $matches[1][0],
            (int) $matches[2][0],
            strtoupper($matches[3][0])
        );
    }
}
