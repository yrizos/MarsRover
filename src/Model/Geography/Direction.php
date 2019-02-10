<?php

namespace MarsRover\Model\Geography;

use MarsRover\Exception\InvalidDirectionException;

class Direction
{
    private $direction;

    public function __construct(string $direction)
    {
        $direction = trim($direction);
        $direction = strtoupper($direction);

        if (!in_array($direction, ['N', 'S', 'W', 'E'])) {
            throw new InvalidDirectionException('Direction ' . $direction . ' is invalid.');
        }

        $this->direction = $direction;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getLeft(): Direction
    {
        switch ($this->getDirection()) {
            case 'N':
                return new Direction('W');

            case 'W':
                return new Direction('S');

            case 'S':
                return new Direction('E');

            case 'E':
                return new Direction('N');
        }

        return $this;
    }

    public function getRight(): Direction
    {
        switch ($this->getDirection()) {
            case 'N':
                return new Direction('E');

            case 'W':
                return new Direction('N');

            case 'S':
                return new Direction('W');

            case 'E':
                return new Direction('S');
        }

        return $this;
    }


}