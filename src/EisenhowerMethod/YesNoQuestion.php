<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

class YesNoQuestion
{
    private bool $criteria;

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
        $this->criteria = $answer;

        return $this;
    }

    public function getAnwser()
    {
        return $this->criteria;
    }
}
