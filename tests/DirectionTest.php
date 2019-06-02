<?php declare (strict_types = 1);

namespace MarsRover;

class DirectionTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        foreach (['n', 's', 'w', 'e'] as $value) {
            $direction = new \MarsRover\Model\Geography\Direction($value);

            $this->assertSame(strtoupper($value), $direction->getDirection());
        }
    }

    public function testConstructorFail(): void
    {
        $this->expectException(\MarsRover\Exception\InvalidDirectionException::class);

        new \MarsRover\Model\Geography\Direction('a');
    }

    public function testGetLeftRight(): void
    {
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $this->assertSame('W', $direction->getLeft()->getDirection());
        $this->assertSame('E', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('W');

        $this->assertSame('S', $direction->getLeft()->getDirection());
        $this->assertSame('N', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('S');

        $this->assertSame('E', $direction->getLeft()->getDirection());
        $this->assertSame('W', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('E');

        $this->assertSame('N', $direction->getLeft()->getDirection());
        $this->assertSame('S', $direction->getRight()->getDirection());
    }
}
