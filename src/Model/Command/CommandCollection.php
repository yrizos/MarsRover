<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

class CommandCollection implements \Countable, \Iterator
{
    /**
     * @var CommandInterface[]
     */
    private $commands = [];

    /**
     * @var int
     */
    private $position = 0;

    public function addCommand(CommandInterface $command): self
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * @param CommandInterface[] $commands
     */
    public function addCommands(array $commands): self
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->getCommands());
    }

    /**
     * @return CommandInterface
     */
    public function current(): CommandInterface
    {
        return $this->getCommands()[$this->position];
    }

    /**
     * @return CommandInterface[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->getCommands()[$this->position]);
    }
}
