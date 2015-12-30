<?php

namespace AppBundle\Controller;

use Domain\Entity\Task;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TasksController extends FOSRestController
{
    public function getTasksAction()
    {
        $tasks = $this->get('repository.task')->findAll();

        $view = $this->view($tasks, 200);

        return $this->handleView($view);
    }

    public function getTaskAction($id)
    {
        $task = $this->get('repository.task')->find($id);

        if (empty($task)) {
            throw new HttpException(404, 'Task not found.');
        }

        $view = $this->view($task, 200);

        return $this->handleView($view);
    }

    public function postTasksAction(Request $request)
    {
        $name = $request->get('name');

        if (empty($name)) {
            throw new HttpException(400, 'Missing required parameters');
        }

        $task = new Task($name);

        $this->get('repository.task')->add($task);

        $view = $this->view($task, 201);

        return $this->handleView($view);
    }
}
