<?php

namespace Infrastructure\ODM;

use Doctrine\Common\Persistence\ObjectManager;
use Domain\Entity\Task;
use Domain\Repository\TaskRepository;

class ODMTaskRepository implements TaskRepository
{
    /** @var \Doctrine\Common\Persistence\ObjectManager */
    protected $manager;

    /**
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /** {@inheritdoc} */
    public function findAll()
    {
        return $this->manager->getRepository(Task::class)->findAll();
    }

    /** {@inheritdoc} */
    public function add(Task $task)
    {
        $this->manager->persist($task);
        $this->manager->flush();
    }
}
