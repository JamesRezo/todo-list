<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateTimeImmutable;
use Jamesrezo\TodoList\EisenhowerMethod\Internal\Interaction;
use Jamesrezo\TodoList\EisenhowerMethod\Internal\Quadrant;

class Decision implements DecisionInterface
{
    private Interaction $interaction;

    private ?Task $task = null;

    public function __construct()
    {
        $this->interaction = new Interaction;
    }

    protected function is(YesNoQuestion $criteria): bool
    {
        return $criteria->getAnwser();
    }

    protected function when(DeadlineQuestion $criteria): ?DateTimeImmutable
    {
        return $criteria->getAnwser();
    }

    public function getInteraction(): Interaction
    {
        return $this->interaction;
    }

    public function compute(): self
    {
        $questions = $this->interaction->receiveQuestions();
        $important = $this->is($questions['important']);
        $urgent = $this->is($questions['urgent']);
        $deadline = $this->when($questions['deadline']);

        $this->task = Quadrant::compute($important, $urgent, $deadline);

        return $this;
    }
    
    public function deliver(): Task
    {
        if (\is_null($this->task)) {
            throw new \RuntimeException('Quadrant must be computed before delivery of the decision.');
        }

        return $this->task;
    }

    public function needDeadline(bool $important, bool $urgent): bool
    {
        return $important && !$urgent;
    }
}
