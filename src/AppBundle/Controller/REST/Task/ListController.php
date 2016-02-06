<?php

namespace AppBundle\Controller\REST\Task;

use Domain\UseCase\ListTasks;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ListController extends FOSRestController implements ListTasks\Responder
{
    /** @var array */
    private $tasks;

    public function __construct()
    {
        $this->tasks = array();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function executeAction()
    {
        $useCase = $this->get('use_case.list_tasks');

        $useCase->execute(new ListTasks\Command(), $this);

        $view = $this->view($this->tasks, 200);

        return $this->handleView($view);
    }

    /** {@inheritdoc} */
    public function tasksSuccessfullyFound($tasks)
    {
        $this->tasks = $tasks;
    }
}
