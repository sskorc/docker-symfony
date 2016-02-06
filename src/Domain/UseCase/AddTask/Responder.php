<?php

namespace Domain\UseCase\AddTask;

use Domain\Entity\Task;

interface Responder
{
    /**
     * @param \Domain\Entity\Task $task
     *
     * @return void
     */
    public function taskSuccessfullyAdded(Task $task);
}
