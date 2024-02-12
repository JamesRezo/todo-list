<?php

namespace Jamesrezo\TodoList\EisenhowerMethod\Internal;

use DateTimeImmutable;

class DeadlineQuestion implements QuestionInterface
{
    private ?DateTimeImmutable $deadline = null;

    public function __construct(
        private string $question,
        private bool $important,
        private bool $urgent,
    ) {
    }

    public function condition(): bool
    {
        return $this->important && !$this->urgent;
    }

    public function askQuestion(): string
    {
        return $this->question;
    }

    public function registerAnswer($answer): QuestionInterface
    {
        $this->deadline = $answer;
    
        return $this;
    }

    public function getAnswer()
    {
        return $this->deadline;
    }
}
