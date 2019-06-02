<?php declare(strict_types=1);

class InputTest extends \PHPUnit\Framework\TestCase
{
    public function testParsePosition(): void
    {
        $input    = '2 3';
        $position = \MarsRover\IO\PlateauInput::parsePosition($input);

        $this->assertSame(2, $position->getX());
        $this->assertSame(3, $position->getY());
    }

    public function testParsePose(): void
    {
        $input = '2 3 N';
        $pose  = \MarsRover\IO\RoverInput::parsePose($input);

        $this->assertSame(2, $pose->getPosition()->getX());
        $this->assertSame(3, $pose->getPosition()->getY());
        $this->assertSame('N', $pose->getDirection()->getDirection());

        $input = '5 2 W';
        $pose  = \MarsRover\IO\RoverInput::parsePose($input);

        $this->assertSame(5, $pose->getPosition()->getX());
        $this->assertSame(2, $pose->getPosition()->getY());
        $this->assertSame('W', $pose->getDirection()->getDirection());
    }

    public function testParseCommands(): void
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

        $this->assertSame($expected, $commands);

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

        $this->assertSame($expected, $commands);
    }

    public function testInput(): void
    {
        $input = new \MarsRover\IO\Input(
            '
                5 5
                1 2 N
                LMLMLMLMM
                3 3 E
                MMRMMRMRRM            
            '
        );

        $plateau_input = $input->getPlateau();
        $this->assertSame(
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
            $this->assertSame($expected_rovers_input[$index][0], $item->getPose());
            $this->assertSame($expected_rovers_input[$index][1], $item->getCommands());
        }
    }
}
