<?php

namespace spec\Domain\UseCase;

use Domain\Entity\Task;
use Domain\Repository\TaskRepository;
use Domain\UseCase\AddTask\Command;
use Domain\UseCase\AddTask\Responder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AddTaskSpec extends ObjectBehavior
{
    function let(TaskRepository $taskRepository)
    {
        $this->beConstructedWith($taskRepository);
    }

    function it_should_add_task(TaskRepository $taskRepository, Responder $responder)
    {
        $name = 'Dummy task';

        $this->execute(new Command($name), $responder);

        $taskRepository->add(Argument::type(Task::class))->shouldHaveBeenCalled();
        $responder->taskSuccessfullyAdded(Argument::type(Task::class))->shouldHaveBeenCalled();
    }
}
