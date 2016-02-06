<?php

namespace Domain\Repository;

use Domain\Entity\Task;

interface TaskRepository
{
    /**
     * @return array
     */
    public function findAll();

    /**
     * @param \Domain\Entity\Task $task
     *
     * @return void
     */
    public function add(Task $task);
}
