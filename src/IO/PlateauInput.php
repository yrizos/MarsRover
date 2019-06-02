<?php declare (strict_types = 1);

namespace MarsRover\IO;

use MarsRover\Exception\InvalidInputException;
use MarsRover\Model\Geography\Position;
use MarsRover\Model\HasPositionTrait;

class PlateauInput
{
    use HasPositionTrait;

    public function __construct(string $position)
    {
        $this->setPosition(self::parsePosition($position));
    }

    public static function parsePosition(string $string): Position
    {
        $string  = trim($string);
        $pattern = '/([0-9]{0,15}) ([0-9]{0,15})/';

        if (! preg_match($pattern, $string, $matches, PREG_OFFSET_CAPTURE)) {
            throw new InvalidInputException($string . ' is not valid position input.');
        }

        return new Position(
            (int) $matches[1][0],
            (int) $matches[2][0]
        );
    }
}
