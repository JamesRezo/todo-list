<?php

namespace Jamesrezo\TodoList\Todo;

use Jamesrezo\TodoList\EisenhowerMethod\TaskInterface;
use Jamesrezo\TodoList\EisenhowerMethod\Exception\UnexpectedPropertyException;

class TodoTask implements TodoTaskInterface
{
    public function __construct(
        private string $name,
        private TaskInterface $task,
    ) {
    }

    public function __get($name): mixed
    {
        if (!\in_array($name, ['who', 'when', 'ikeSays'])) {
            throw new UnexpectedPropertyException('Not a Task property');
        }

        return $this->task->$name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
