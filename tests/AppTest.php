<?php declare (strict_types = 1);

class AppTest extends \PHPUnit\Framework\TestCase
{
    public function testRunInput1(): void
    {
        $expected = '1 3 N' . PHP_EOL . '5 1 E';
        $output   = (string) \MarsRover\Application::run(__DIR__ . '/../input/input1.txt');

        $this->assertSame($expected, $output);
    }

    public function testRunInput2(): void
    {
        $expected = '0 0 N' . PHP_EOL . '0 0 N';
        $output   = (string) \MarsRover\Application::run(__DIR__ . '/../input/input2.txt');

        $this->assertSame($expected, $output);
    }
}
