<?php declare (strict_types = 1);

namespace MarsRover\Model\Geography;

class Plateau
{
    /**
     * @var Position
     */
    private $lowerLeftCoordinates;

    /**
     * @var Position
     */
    private $upperRightCoordinates;

    public function __construct(Position $upperRightCoordinates)
    {
        $this->lowerLeftCoordinates  = new Position(0, 0);
        $this->upperRightCoordinates = $upperRightCoordinates;
    }

    public function getLowerLeftCoordinates(): Position
    {
        return $this->lowerLeftCoordinates;
    }

    public function getUpperRightCoordinates(): Position
    {
        return $this->upperRightCoordinates;
    }

    public function isOutOfBounds(Position $coordinates): bool
    {
        return ! (
            $coordinates->getX() >= $this->lowerLeftCoordinates->getX()
            && $coordinates->getY() >= $this->lowerLeftCoordinates->getY()
            && $coordinates->getX() <= $this->upperRightCoordinates->getX()
            && $coordinates->getY() <= $this->upperRightCoordinates->getY()
        );
    }
}
