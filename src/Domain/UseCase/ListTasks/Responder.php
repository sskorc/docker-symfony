<?php

namespace Domain\UseCase\ListTasks;

interface Responder
{
    /**
     * @param $tasks
     * 
     * @return void
     */
    public function tasksSuccessfullyFound($tasks);
}
