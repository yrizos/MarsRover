<?php declare (strict_types = 1);

namespace MarsRover\IO;

class Input
{
    /**
     * @var PlateauInput
     */
    private $plateau;

    /**
     * @var RoverInput[]
     */
    private $rovers = [];

    public function __construct(string $input)
    {
        $input = trim($input);
        $input = strtr($input, [
            "\r\n" => PHP_EOL,
            "\r"   => PHP_EOL,
            "\n"   => PHP_EOL,
        ]);

        $input   = explode(PHP_EOL, $input);
        $input   = array_map('trim', $input);
        $plateau = array_shift($input);

        if (empty($plateau)) {
            $plateau = '';
        }

        $this->plateau = new PlateauInput($plateau);

        foreach ($input as $index => $line) {
            if ($index % 2 === 1) {
                continue;
            }

            $this->rovers[] = new RoverInput(
                $line,
                $input[$index + 1] ?? ''
            );
        }
    }

    public function getPlateau(): PlateauInput
    {
        return $this->plateau;
    }

    /**
     * @return RoverInput[]
     */
    public function getRovers(): array
    {
        return $this->rovers;
    }
}
