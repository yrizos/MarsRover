<?php

class PlateauTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructor()
    {
        $lowerLeftCoordinates  = new \MarsRover\Model\Geography\Position(0, 0);
        $upperRightcoordinates = new \MarsRover\Model\Geography\Position(3, 4);
        $plateau               = new \MarsRover\Model\Geography\Plateau($upperRightcoordinates);

        $this->assertEquals($lowerLeftCoordinates->getX(), $plateau->getLowerLeftCoordinates()->getX());
        $this->assertEquals($lowerLeftCoordinates->getY(), $plateau->getLowerLeftCoordinates()->getY());
        $this->assertEquals($upperRightcoordinates->getX(), $plateau->getUpperRightCoordinates()->getX());
        $this->assertEquals($upperRightcoordinates->getY(), $plateau->getUpperRightCoordinates()->getY());
    }

    public function testIsOutOfBounds()
    {
        $plateau = new \MarsRover\Model\Geography\Plateau(new \MarsRover\Model\Geography\Position(4, 5));

        for (
            $x = $plateau->getLowerLeftCoordinates()->getX();
            $x <= $plateau->getUpperRightCoordinates()->getX();
            $x++
        ) {

            for (
                $y = $plateau->getLowerLeftCoordinates()->getY();
                $y <= $plateau->getUpperRightCoordinates()->getY();
                $y++
            ) {
                $coordinates = new \MarsRover\Model\Geography\Position($x, $y);

                $this->assertFalse($plateau->isOutOfBounds($coordinates));
            }
        }
    }

    public function testIsOutOfBoundsFail()
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