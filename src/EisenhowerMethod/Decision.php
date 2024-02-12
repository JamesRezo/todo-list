<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use Jamesrezo\TodoList\EisenhowerMethod\Internal\DeadlineQuestion;
use Jamesrezo\TodoList\EisenhowerMethod\Internal\Quadrant;
use Jamesrezo\TodoList\EisenhowerMethod\Internal\QuestionInterface;
use Jamesrezo\TodoList\EisenhowerMethod\Internal\YesNoQuestion;

class Decision implements DecisionInterface
{
    private Quadrant $quadrant;

    private array $questions;

    /**
     * @var QuestionInterface[]
     */
    private array $answers = [];

    private string $question = '';

    private ?string $key = null;

    public function __construct()
    {
        $this->quadrant = new Quadrant;

        $this->questions = [
            'important' => [YesNoQuestion::class, 'Is it important ?'],
            'urgent' => [YesNoQuestion::class, 'Is it urgent ?'],
            'deadline' => [DeadlineQuestion::class, 'When is the deadline ?'],
        ];
    }

    public function condition(): bool
    {
        $this->key = \array_key_first($this->questions);
        if (\is_null($this->key)) {
            return false;
        }

        $question = \array_shift($this->questions);
        $class = \array_shift($question);
        if ($this->key == 'deadline') {
            $question[] = $this->answers['important']->getAnswer();
            $question[] = $this->answers['urgent']->getAnswer();
        }
        $question = new $class(...$question);

        $this->answers[$this->key] = $question;

        return $question->condition();
    }

    public function askQuestion(): string
    {
        if (\is_null($this->key)) {
            return $this->question;
        }

        return $this->answers[$this->key]->askQuestion();
    }

    public function registerAnswer($answer): self
    {
        $this->answers[$this->key]->registerAnswer($answer);

        return $this;
    }

    public function getAnswer()
    {
        return array_map(function (QuestionInterface $question) {
            return $question->getAnswer();
        }, $this->answers);
    }

    public function deliver(): Task
    {
        $answer = $this->getAnswer();

        return $this->quadrant->compute(...$answer);
    }
}
