<?php

namespace AppBundle\Controller\Web;

use AppBundle\Form\Type\TaskType;
use Domain\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    public function addTaskAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);

        $form->handleRequest($request);

        $response = $this->render(':Tasks:add.html.twig', ['form' => $form->createView()]);

        if ($form->isValid()) {
            $data = $form->getData();
            $task = new Task($data['name']);
            $this->get('repository.task')->add($task);

            $request->getSession()->getFlashbag()->add(
                'success',
                sprintf('Task "%s" successfully created', $task->getName())
            );
            $response = $this->redirectToRoute('web_tasks_list');
        }

        return $response;
    }

    public function getTasksAction()
    {
        $tasks = $this->get('repository.task')->findAll();

        return $this->render(':Tasks:list.html.twig', ['tasks' => $tasks]);
    }
}
