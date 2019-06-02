<?php declare (strict_types = 1);

namespace MarsRover\Model\Command;

class CommandCollection implements \Countable, \Iterator
{
    private $commands = [];

    private $position = 0;

    public function addCommand(CommandInterface $command): self
    {
        $this->commands[] = $command;

        return $this;
    }

    public function addCommands(array $commands): self
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    public function count()
    {
        return count($this->getCommands());
    }

    public function current()
    {
        return $this->getCommands()[$this->position];
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function key()
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

    public function valid()
    {
        return isset($this->getCommands()[$this->position]);
    }
}
