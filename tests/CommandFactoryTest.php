<?php declare (strict_types = 1);

namespace MarsRover;

class CommandFactoryTest extends \PHPUnit\Framework\TestCase
{
    public function testCommandFactory(): void
    {
        $command = \MarsRover\Model\Command\CommandFactory::getCommand('M');

        $this->assertInstanceOf(\MarsRover\Model\Command\MoveForwardCommand::class, $command);

        $command = \MarsRover\Model\Command\CommandFactory::getCommand('L');

        $this->assertInstanceOf(\MarsRover\Model\Command\RotateLeftCommand::class, $command);

        $command = \MarsRover\Model\Command\CommandFactory::getCommand('R');

        $this->assertInstanceOf(\MarsRover\Model\Command\RotateRightCommand::class, $command);
    }

    public function testCommandFactoryFail(): void
    {
        $this->expectException(\MarsRover\Exception\InvalidRoverCommandException::class);

        \MarsRover\Model\Command\CommandFactory::getCommand('F');
    }
}
