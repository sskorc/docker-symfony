<?php

namespace Domain\UseCase\AddTask;

class Command
{
    /** @var string */
    public $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
