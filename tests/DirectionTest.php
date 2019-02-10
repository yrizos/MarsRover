<?php

class DirectionTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructor()
    {
        foreach (['n', 's', 'w', 'e'] as $value) {
            $direction = new \MarsRover\Model\Geography\Direction($value);

            $this->assertEquals(strtoupper($value), $direction->getDirection());
        }
    }

    public function testConstructor_fail()
    {
        $this->expectException(\MarsRover\Exception\InvalidDirectionException::class);

        new \MarsRover\Model\Geography\Direction('a');
    }

    public function testGetLeftRight()
    {
        $direction = new \MarsRover\Model\Geography\Direction('N');

        $this->assertEquals('W', $direction->getLeft()->getDirection());
        $this->assertEquals('E', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('W');

        $this->assertEquals('S', $direction->getLeft()->getDirection());
        $this->assertEquals('N', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('S');

        $this->assertEquals('E', $direction->getLeft()->getDirection());
        $this->assertEquals('W', $direction->getRight()->getDirection());

        $direction = new \MarsRover\Model\Geography\Direction('E');

        $this->assertEquals('N', $direction->getLeft()->getDirection());
        $this->assertEquals('S', $direction->getRight()->getDirection());
    }

}