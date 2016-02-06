<?php

namespace spec\Domain\UseCase;

use Domain\Entity\Task;
use Domain\Repository\TaskRepository;
use Domain\UseCase\ListTasks\Command;
use Domain\UseCase\ListTasks\Responder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ListTasksSpec extends ObjectBehavior
{
    function let(TaskRepository $taskRepository)
    {
        $this->beConstructedWith($taskRepository);
    }

    function it_should_list_tasks(TaskRepository $taskRepository, Task $task, Responder $responder)
    {
        $tasks = array($task);
        $taskRepository->findAll()->willReturn($tasks);

        $this->execute(new Command(), $responder);

        $responder->tasksSuccessfullyFound($tasks)->shouldHaveBeenCalled();
    }
}
