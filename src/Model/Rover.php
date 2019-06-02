<?php declare (strict_types = 1);

namespace MarsRover\Model;

use MarsRover\Exception\InvalidDirectionException;
use MarsRover\Exception\RoverIsOutOfBoundsException;
use MarsRover\Exception\UnsupportedRoverCommandException;
use MarsRover\Model\Command\CommandCollection;
use MarsRover\Model\Command\CommandInterface;
use MarsRover\Model\Command\MoveForwardCommand;
use MarsRover\Model\Command\RotateCommandInterface;
use MarsRover\Model\Geography\Direction;
use MarsRover\Model\Geography\Plateau;
use MarsRover\Model\Geography\Position;

class Rover
{
    use HasDirectionTrait;
    use HasPositionTrait {
        setPosition as protected traitSetPosition;
    }

    private $plateau;

    public function __construct(
        Plateau $plateau,
        Position $position,
        Direction $direction
    ) {
        $this->plateau = $plateau;

        $this->setPosition($position)
            ->setDirection($direction);
    }

    public function __toString()
    {
        return implode(
            ' ',
            [
                $this->getPosition()->getX(),
                $this->getPosition()->getY(),
                $this->getDirection()->getDirection(),
            ]
        );
    }

    public function execute(CommandInterface $command): self
    {
        if ($command instanceof MoveForwardCommand) {
            return $this->move();
        }

        if ($command instanceof RotateCommandInterface) {
            return $this->rotate($command->getDirection());
        }

        throw new UnsupportedRoverCommandException();
    }

    public function executeMultiple(CommandCollection $commands): self
    {
        foreach ($commands as $command) {
            $this->execute($command);
        }

        return $this;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    protected function setPosition(Position $position): self
    {
        if ($this->plateau->isOutOfBounds($position)) {
            throw new RoverIsOutOfBoundsException('Rover cannot move outside the plateau.');
        }

        return $this->traitSetPosition($position);
    }

    private function move(): self
    {
        $direction = $this->getDirection()->getDirection();

        switch ($direction) {
            case 'N':
                $position = new Position(
                    $this->getPosition()->getX(),
                    $this->getPosition()->getY() + 1
                );

                break;

            case 'W':
                $position = new Position(
                    $this->getPosition()->getX() - 1,
                    $this->getPosition()->getY()
                );

                break;

            case 'E':
                $position = new Position(
                    $this->getPosition()->getX() + 1,
                    $this->getPosition()->getY()
                );

                break;

            case 'S':
                $position = new Position(
                    $this->getPosition()->getX(),
                    $this->getPosition()->getY() - 1
                );

                break;

            default:
                throw new InvalidDirectionException();
        }

        return $this->setPosition($position);
    }

    private function rotate(string $direction): self
    {
        if ($direction === 'L') {
            $direction = $this->getDirection()->getLeft();

            return $this->setDirection($direction);
        }

        if ($direction === 'R') {
            $direction = $this->getDirection()->getRight();

            return $this->setDirection($direction);
        }

        throw new InvalidDirectionException();
    }
}
