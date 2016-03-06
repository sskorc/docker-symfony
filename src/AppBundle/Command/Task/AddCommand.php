<?php

namespace AppBundle\Command\Task;

use Domain\Entity\Task;
use Domain\UseCase\AddTask;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddCommand extends ContainerAwareCommand implements AddTask\Responder
{
    /** @var \Domain\Entity\Task */
    private $task;

    /** {@inheritdoc} */
    protected function configure()
    {
        $this
            ->setName('task:add')
            ->setDescription('Add new task')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'What\'s the task?'
            )
        ;
    }

    /** {@inheritdoc} */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        $useCase = $this->getContainer()->get('use_case.add_task');

        $useCase->execute(new AddTask\Command($name), $this);

        if (!empty($this->task)) {
            $message = sprintf('Task "%s" was added', $this->task->getName());
        } else {
            $message = 'Task wasn\'t added';
        }

        $output->writeln($message);
    }

    /** {@inheritdoc} */
    public function taskSuccessfullyAdded(Task $task)
    {
        $this->task = $task;
    }
}
