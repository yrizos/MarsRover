<?php

class RoverTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructor()
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('s');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $this->assertEquals($position->getX(), $rover->getPosition()->getX());
        $this->assertEquals($position->getY(), $rover->getPosition()->getY());
        $this->assertEquals($direction->getDirection(), $rover->getDirection()->getDirection());
    }

    public function testRotate()
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertEquals('W', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertEquals('S', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertEquals('E', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertEquals('N', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertEquals('E', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertEquals('S', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertEquals('W', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertEquals('N', $rover->getDirection()->getDirection());
    }

    public function testMoveForward()
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertEquals(1, $rover->getPosition()->getX());
        $this->assertEquals(3, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertEquals(1, $rover->getPosition()->getX());
        $this->assertEquals(4, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertEquals(2, $rover->getPosition()->getX());
        $this->assertEquals(4, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertEquals(3, $rover->getPosition()->getX());
        $this->assertEquals(4, $rover->getPosition()->getY());
    }

    public function testMoveForward_fail()
    {
        $this->expectException(\MarsRover\Exception\RoverIsOutOfBoundsException::class);

        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(3, 4);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());
        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());
    }

}