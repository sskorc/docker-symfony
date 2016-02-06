<?php

namespace AppBundle\Controller\Web\Task;

use Domain\UseCase\ListTasks;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller implements ListTasks\Responder
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

        return $this->render(':Tasks:list.html.twig', ['tasks' => $this->tasks]);
    }

    /** {@inheritdoc} */
    public function tasksSuccessfullyFound($tasks)
    {
        $this->tasks = $tasks;
    }
}
