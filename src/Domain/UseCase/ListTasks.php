<?php

namespace Domain\UseCase;

use Domain\Repository\TaskRepository;
use Domain\UseCase\ListTasks\Command;
use Domain\UseCase\ListTasks\Responder;

class ListTasks
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
     * @param \Domain\UseCase\ListTasks\Command $command
     * @param \Domain\UseCase\ListTasks\Responder $responder
     */
    public function execute(Command $command, Responder $responder)
    {
        $buyers = $this->taskRepository->findAll();

        $responder->tasksSuccessfullyFound($buyers);
    }
}
