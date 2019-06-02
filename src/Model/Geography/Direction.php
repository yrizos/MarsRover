<?php declare (strict_types = 1);

namespace MarsRover\Model\Geography;

use MarsRover\Exception\InvalidDirectionException;

class Direction
{
    /**
     * @var string
     */
    private $direction;

    public function __construct(string $direction)
    {
        $direction = trim($direction);
        $direction = strtoupper($direction);

        if (! in_array($direction, ['N', 'S', 'W', 'E'], true)) {
            throw new InvalidDirectionException('Direction ' . $direction . ' is invalid.');
        }

        $this->direction = $direction;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getLeft(): self
    {
        switch ($this->getDirection()) {
            case 'N':
                return new self('W');

            case 'W':
                return new self('S');

            case 'S':
                return new self('E');

            case 'E':
                return new self('N');
        }

        return $this;
    }

    public function getRight(): self
    {
        switch ($this->getDirection()) {
            case 'N':
                return new self('E');

            case 'W':
                return new self('N');

            case 'S':
                return new self('W');

            case 'E':
                return new self('S');
        }

        return $this;
    }
}
