<?php declare (strict_types = 1);

namespace MarsRover;

class PlateauTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $lowerLeftCoordinates  = new \MarsRover\Model\Geography\Position(0, 0);
        $upperRightcoordinates = new \MarsRover\Model\Geography\Position(3, 4);
        $plateau               = new \MarsRover\Model\Geography\Plateau($upperRightcoordinates);

        $this->assertSame($lowerLeftCoordinates->getX(), $plateau->getLowerLeftCoordinates()->getX());
        $this->assertSame($lowerLeftCoordinates->getY(), $plateau->getLowerLeftCoordinates()->getY());
        $this->assertSame($upperRightcoordinates->getX(), $plateau->getUpperRightCoordinates()->getX());
        $this->assertSame($upperRightcoordinates->getY(), $plateau->getUpperRightCoordinates()->getY());
    }

    public function testIsOutOfBounds(): void
    {
        $plateau = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));

        for ($x = $plateau->getLowerLeftCoordinates()->getX(); $x <= $plateau->getUpperRightCoordinates()->getX(); $x++) {
            for ($y = $plateau->getLowerLeftCoordinates()->getY(); $y <= $plateau->getUpperRightCoordinates()->getY(); $y++) {
                $coordinates = new \MarsRover\Model\Geography\Position($x, $y);

                $this->assertFalse($plateau->isOutOfBounds($coordinates));
            }
        }
    }

    public function testIsOutOfBoundsFail(): void
    {
        $plateau = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));

        for ($y = 0; $y < 5; $y++) {
            $this->assertTrue($plateau->isOutOfBounds(new \MarsRover\Model\Geography\Position(-1, $y)));
            $this->assertTrue($plateau->isOutOfBounds(new \MarsRover\Model\Geography\Position(5, $y)));
        }

        for ($x = 0; $x < 4; $x++) {
            $this->assertTrue($plateau->isOutOfBounds(new \MarsRover\Model\Geography\Position($x, -1)));
            $this->assertTrue($plateau->isOutOfBounds(new \MarsRover\Model\Geography\Position($x, 6)));
        }
    }
}
