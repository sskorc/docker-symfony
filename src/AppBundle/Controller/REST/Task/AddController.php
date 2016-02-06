<?php

namespace AppBundle\Controller\REST\Task;

use Domain\Entity\Task;
use Domain\UseCase\AddTask;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AddController extends FOSRestController implements AddTask\Responder
{
    /** @var \Domain\Entity\Task */
    private $task;

    /**
     * @param \Symfony\Component\HttpFoundation\Request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function executeAction(Request $request)
    {
        $name = $request->get('name');

        if (empty($name)) {
            throw new HttpException(400, 'Missing required parameters');
        }

        $useCase = $this->get('use_case.add_task');

        $useCase->execute(new AddTask\Command($name), $this);

        $view = $this->view($this->task, 201);

        return $this->handleView($view);
    }

    /** {@inheritdoc} */
    public function taskSuccessfullyAdded(Task $task)
    {
        $this->task = $task;
    }
}
