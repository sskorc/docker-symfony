<?php

namespace AppBundle\Controller\Web\Task;

use AppBundle\Form\Type\TaskType;
use Domain\Entity\Task;
use Domain\UseCase\AddTask;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddController extends Controller implements AddTask\Responder
{
    /** @var \Symfony\Component\HttpFoundation\Request */
    private $request;

    /** @var \Symfony\Component\HttpFoundation\Response */
    private $response;

    /**
     * @param \Symfony\Component\HttpFoundation\Request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function executeAction(Request $request)
    {
        $form = $this->createForm(TaskType::class);

        $form->handleRequest($request);

        $this->request = $request;
        $this->response = $this->render(':Tasks:add.html.twig', ['form' => $form->createView()]);

        if ($form->isValid()) {
            $data = $form->getData();
            $name = $data['name'];

            $useCase = $this->get('use_case.add_task');

            $useCase->execute(new AddTask\Command($name), $this);
        }

        return $this->response;
    }

    /** {@inheritdoc} */
    public function taskSuccessfullyAdded(Task $task)
    {
        $this->request->getSession()->getFlashbag()->add(
            'success',
            sprintf('Task "%s" successfully created', $task->getName())
        );
        $this->response = $this->redirectToRoute('web_tasks_list');
    }
}
