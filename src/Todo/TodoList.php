<?php

namespace Jamesrezo\TodoList\Todo;

use DateInterval;
use Jamesrezo\TodoList\EisenhowerMethod\Task;
use Jamesrezo\TodoList\EisenhowerMethod\Task\Who;
use Jamesrezo\TodoList\EisenhowerMethod\TaskFactory;
use Jamesrezo\TodoList\Todo\Exception\EmptyTodoListException;
use Jamesrezo\TodoList\Todo\Exception\NotFoundTaskException;

class TodoList
{
    public function __construct(
        /** @var Task[] */
        private array $tasks = [],
    ) {
    }

    public function isEmpty(): bool
    {
        return empty($this->tasks);
    }

    public function add(Task $task): self
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * @param bool $sort Sort by ascending deadline if true (default), not sorted otherwise
     *
     * @return TodoList Copy of the todo-list with Your Tasks
     */
    public function mine(bool $sort = true): static
    {
        $tasks = $this->tasks;
        if ($sort) {
            \asort($tasks);
        }

        return new static(array_values(\array_filter($tasks, function (Task $task) {
            return $task->who == Who::You;
        })));
    }

    /**
     * @param bool $sort Sort by ascending deadline if true (default), not sorted otherwise
     * @param boolean $findSomeone select only the tasks Ike says to find someone, all backlog tasks otherwise
     *
     * @return TodoList Copy of the todo-list with the delegates Tasks
     */
    public function backlog(bool $sort = true, bool $findSomeone = true): static
    {
        $tasks = $this->tasks;
        if ($sort) {
            \asort($tasks);
        }

        return new static(\array_values(\array_filter($this->tasks, function (Task $task) use ($findSomeone) {
            $filter = $task->who == Who::Delegate;
            if ($findSomeone) {
                $filter = $filter && \str_starts_with($task->ikeSays, 'Find');
            }

            return $filter;
        })));
    }

    /**
     * Pick the first task of a todo-list.
     * 
     * @throws EmptyTodoListException
     */
    public function pick(): Task
    {
        if ($this->isEmpty()) {
            throw new EmptyTodoListException('Cannot pick. TodoList is empty');
        }

        return $this->tasks[0];
    }

    /**
     * Defer the deadline of a task in the todo-ist
     *
     * @throws NotFoundTaskException
     */
    public function postpone(Task $task, DateInterval $defer): self
    {
        $offset = \array_search($task, $this->tasks);
        if ($offset === false) {
            throw new NotFoundTaskException('Task not found');
        }

        $newTask = new Task($task->who, $task->when->add($defer), 'Defered');
        $this->tasks = \array_replace($this->tasks, [$offset => $newTask]);

        return $this;
    }

    /**
     * Mark the task as complete.
     * 
     * {@see TodoList::drop() Just drop it.}
     */
    public function complete(Task $task): self
    {
        return $this->drop($task);
    }

    /**
     * Remove a task from the todo-list
     */
    public function drop(Task $task): self
    {
        $offset = \array_search($task, $this->tasks);
        if ($offset === false) {
            throw new NotFoundTaskException('Task not found');
        }

        \array_splice($this->tasks, $offset, 1);

        return $this;
    }

    /**
     * Transfer a Task to another todo-list
     */
    public function delegate(Task $task, TodoList $delegate): self
    {
        $offset = \array_search($task, $this->tasks);
        if ($offset === false) {
            throw new NotFoundTaskException('Task not found');
        }

        $newTask = new Task(Who::You, null, 'Delegated by a friend');
        $delegate->add($newTask);
        $this->drop($task);

        return $this;
    }

    /**
     * Change Task status in the todo-list by a new decision.
     * 
     * @see EisenhowerMethod\TaskFactory::createTask()
     *
     * @throws MissingDeadlineException
     */
    public function reprioritize(Task $task, bool $important, bool $urgent, ?DateInterval $deadline = null): self
    {
        $offset = \array_search($task, $this->tasks);
        if ($offset === false) {
            throw new NotFoundTaskException('Task not found');
        }

        $newTask = TaskFactory::createTask($important, $urgent, $deadline);
        $this->tasks = \array_replace($this->tasks, [$offset => $newTask]);

        return $this;
    }
}
