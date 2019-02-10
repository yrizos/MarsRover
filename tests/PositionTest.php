<?php

class PositionTest extends \PHPUnit\Framework\TestCase
{

    public function testConstructor()
    {
        $position = new \MarsRover\Model\Geography\Position(1, 5);

        $this->assertEquals(1, $position->getX());
        $this->assertEquals(5, $position->getY());
    }

}