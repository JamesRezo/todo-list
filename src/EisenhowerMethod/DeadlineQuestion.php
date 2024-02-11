<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateTimeImmutable;

class DeadlineQuestion
{
    private ?DateTimeImmutable $deadline = null;

    public function __construct(
        private string $question,
    ) {
    }

    public function ask(): string
    {
        return $this->question;
    }

    public function setAnswer($answer): self
    {
        $this->deadline = $answer;

        return $this;
    }

    public function getAnwser()
    {
        return $this->deadline;
    }
}
