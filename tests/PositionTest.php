<?php declare (strict_types = 1);

class PositionTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $position = new \MarsRover\Model\Geography\Position(1, 5);

        $this->assertSame(1, $position->getX());
        $this->assertSame(5, $position->getY());
    }
}
