<?php declare (strict_types = 1);

class RoverTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('s');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $this->assertSame($position->getX(), $rover->getPosition()->getX());
        $this->assertSame($position->getY(), $rover->getPosition()->getY());
        $this->assertSame($direction->getDirection(), $rover->getDirection()->getDirection());
    }

    public function testMoveForward(): void
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertSame(1, $rover->getPosition()->getX());
        $this->assertSame(3, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertSame(1, $rover->getPosition()->getX());
        $this->assertSame(4, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertSame(2, $rover->getPosition()->getX());
        $this->assertSame(4, $rover->getPosition()->getY());

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());

        $this->assertSame(3, $rover->getPosition()->getX());
        $this->assertSame(4, $rover->getPosition()->getY());
    }

    public function testMoveForwardFail(): void
    {
        $this->expectException(\MarsRover\Exception\RoverIsOutOfBoundsException::class);

        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(3, 4);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());
        $rover->execute(new \MarsRover\Model\Command\MoveForwardCommand());
    }

    public function testRotate(): void
    {
        $plateau   = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));
        $position  = new \MarsRover\Model\Geography\Position(1, 2);
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $rover = new \MarsRover\Model\Rover($plateau, $position, $direction);

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertSame('W', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertSame('S', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertSame('E', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateLeftCommand());
        $this->assertSame('N', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertSame('E', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertSame('S', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertSame('W', $rover->getDirection()->getDirection());

        $rover->execute(new \MarsRover\Model\Command\RotateRightCommand());
        $this->assertSame('N', $rover->getDirection()->getDirection());
    }
}
