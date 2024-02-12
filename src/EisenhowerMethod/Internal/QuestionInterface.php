<?php

namespace Jamesrezo\TodoList\EisenhowerMethod\Internal;

interface QuestionInterface
{
    public function condition(): bool;

    public function askQuestion(): string;

    public function registerAnswer($answer): self;

    public function getAnswer();
}
