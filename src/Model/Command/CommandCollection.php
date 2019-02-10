<?php

namespace MarsRover\Model\Command;

class CommandCollection implements \Countable, \Iterator
{
    private $commands = [];
    private $position = 0;

    public function addCommands(array $commands): CommandCollection
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }

        return $this;
    }

    public function addCommand(CommandInterface $command): CommandCollection
    {
        $this->commands[] = $command;

        return $this;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function count()
    {
        return count($this->getCommands());
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->getCommands()[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->getCommands()[$this->position]);
    }

}