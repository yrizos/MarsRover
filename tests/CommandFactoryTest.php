<?php

class CommandFactoryTest extends \PHPUnit\Framework\TestCase
{

    public function testCommandFactory()
    {
        $command = \MarsRover\Model\Command\CommandFactory::getCommand('M');

        $this->assertInstanceOf(\MarsRover\Model\Command\MoveForwardCommand::class, $command);

        $command = \MarsRover\Model\Command\CommandFactory::getCommand('L');

        $this->assertInstanceOf(\MarsRover\Model\Command\RotateLeftCommand::class, $command);

        $command = \MarsRover\Model\Command\CommandFactory::getCommand('R');

        $this->assertInstanceOf(\MarsRover\Model\Command\RotateRightCommand::class, $command);
    }

    public function testCommandFactory_fail()
    {
        $this->expectException(\MarsRover\Exception\InvalidRoverCommandException::class);

        \MarsRover\Model\Command\CommandFactory::getCommand('F');
    }


}