<?php

namespace Jamesrezo\TodoList\EisenhowerMethod\Internal;

class YesNoQuestion implements QuestionInterface
{
    private bool $criteria;

    public function __construct(
        private string $question,
    ) {
    }

    public function condition(): bool
    {
        return true;
    }

    public function askQuestion(): string
    {
        return $this->question;
    }

    public function registerAnswer($answer): self
    {
        $this->criteria = $answer;

        return $this;
    }

    public function getAnswer()
    {
        return $this->criteria;
    }
}
