<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateTimeImmutable;

class Decision
{
    private ?Task $task = null;

    public function __construct(
        private YesNoQuestion $important,
        private YesNoQuestion $urgent,
        private DeadlineQuestion $deadline,
    ) {
    }

    protected function is(YesNoQuestion $criteria): bool
    {
        return $criteria->getAnwser();
    }

    protected function when(DeadlineQuestion $criteria): ?DateTimeImmutable
    {
        return $criteria->getAnwser();
    }

    public function computeQuadrantAndDeliver(): Task
    {
        return $this->compute()->deliver();
    }

    public function compute(): self
    {
        $important = $this->important;
        $urgent = $this->urgent;
        $deadline = $this->deadline;

        if ($this->is($important)) {
            if ($this->is($urgent)) {
                // Important/Urgent quadrant task
                $this->task = new Task(who:Who::You, when:new DateTimeImmutable(), ikeSays:null);
            }

            // Important/Not Urgent quadrant task
            $this->task = new Task(who:Who::You, when:$this->when($deadline), ikeSays:null);
        } else {
            if ($this->is($urgent)) {
                // Unimportant/Urgent quadrant task
                $this->task = new Task(who:Who::Delegate, when:null, ikeSays:'Find some else, then drop it');
            } else {
                // Unimportant/Not Urgent quadrant task
                $this->task = new Task(who:Who::Delegate, when:null, ikeSays:'Just drop it');
            }
        }

        return $this;
    }

    public function deliver(): Task
    {
        if (\is_null($this->task)) {
            throw new \RuntimeException('Quadrant must be computed before delivery of the decision.');
        }

        return $this->task;
    }

    public static function needDeadline(bool $important, bool $urgent): bool
    {
        return $important && !$urgent;
    }
}
