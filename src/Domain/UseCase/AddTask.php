<?php

namespace Domain\UseCase;

use Domain\Entity\Task;
use Domain\Repository\TaskRepository;
use Domain\UseCase\AddTask\Command;
use Domain\UseCase\AddTask\Responder;

class AddTask
{
    /** @var \Domain\Repository\TaskRepository */
    private $taskRepository;

    /**
     * @param \Domain\Repository\TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @param \Domain\UseCase\AddTask\Command $command
     * @param \Domain\UseCase\AddTask\Responder $responder
     */
    public function execute(Command $command, Responder $responder)
    {
        $task = new Task($command->name);

        $this->taskRepository->add($task);

        $responder->taskSuccessfullyAdded($task);
    }
}
