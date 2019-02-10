<?php

class InputTest extends \PHPUnit\Framework\TestCase
{
    public function testParsePosition()
    {
        $input    = '2 3';
        $position = \MarsRover\IO\PlateauInput::parsePosition($input);

        $this->assertEquals(2, $position->getX());
        $this->assertEquals(3, $position->getY());
    }

    public function testParsePose()
    {
        $input = '2 3 N';
        $pose  = \MarsRover\IO\RoverInput::parsePose($input);

        $this->assertEquals(2, $pose->getPosition()->getX());
        $this->assertEquals(3, $pose->getPosition()->getY());
        $this->assertEquals('N', $pose->getDirection()->getDirection());

        $input = '5 2 W';
        $pose  = \MarsRover\IO\RoverInput::parsePose($input);

        $this->assertEquals(5, $pose->getPosition()->getX());
        $this->assertEquals(2, $pose->getPosition()->getY());
        $this->assertEquals('W', $pose->getDirection()->getDirection());
    }

    public function testParseCommands()
    {
        $expected = (new \MarsRover\Model\Command\CommandCollection())
            ->addCommands(
                [
                    new \MarsRover\Model\Command\RotateLeftCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateLeftCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateLeftCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateLeftCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                ]
            );

        $input    = 'LMLMLMLMM';
        $commands = \MarsRover\IO\RoverInput::parseCommands($input);

        $this->assertEquals($expected, $commands);

        $expected = (new \MarsRover\Model\Command\CommandCollection())
            ->addCommands(
                [
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateRightCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateRightCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                    new \MarsRover\Model\Command\RotateRightCommand(),
                    new \MarsRover\Model\Command\RotateRightCommand(),
                    new \MarsRover\Model\Command\MoveForwardCommand(),
                ]
            );

        $input    = 'MMRMMRMRRM';
        $commands = \MarsRover\IO\RoverInput::parseCommands($input);

        $this->assertEquals($expected, $commands);
    }

    public function testInput()
    {

        $input = new \MarsRover\IO\Input(
            "
                5 5
                1 2 N
                LMLMLMLMM
                3 3 E
                MMRMMRMRRM            
            "
        );

        $plateau_input = $input->getPlateau();
        $this->assertEquals(
            new \MarsRover\Model\Geography\Position(5, 5),
            $plateau_input->getPosition()
        );

        $rovers_input          = $input->getRovers();
        $expected_rovers_input = [
            [
                new \MarsRover\Model\Geography\Pose(1, 2, 'N'),

                (new \MarsRover\Model\Command\CommandCollection())
                    ->addCommands(
                        [
                            new \MarsRover\Model\Command\RotateLeftCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateLeftCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateLeftCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateLeftCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                        ]
                    ),
            ],
            [
                new \MarsRover\Model\Geography\Pose(3, 3, 'E'),
                (new \MarsRover\Model\Command\CommandCollection())
                    ->addCommands(
                        [
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateRightCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateRightCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                            new \MarsRover\Model\Command\RotateRightCommand(),
                            new \MarsRover\Model\Command\RotateRightCommand(),
                            new \MarsRover\Model\Command\MoveForwardCommand(),
                        ]
                    ),
            ],
        ];

        foreach ($rovers_input as $index => $item) {
            $this->assertEquals($expected_rovers_input[$index][0], $item->getPose());
            $this->assertEquals($expected_rovers_input[$index][1], $item->getCommands());
        }
    }
}