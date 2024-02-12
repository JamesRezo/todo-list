<?php

namespace Jamesrezo\TodoList\EisenhowerMethod\Internal;

use Jamesrezo\TodoList\EisenhowerMethod\DeadlineQuestion;
use Jamesrezo\TodoList\EisenhowerMethod\YesNoQuestion;

/**
 * @internal description
 * 
 * @author JamesRezo <james@rezo.net>
 */
final class Interaction
{
    const QUESTIONS = [
        'important' => [
            'class' => YesNoQuestion::class,
            'question' => 'Is it important ?',
        ],
        'urgent' => [
            'class' => YesNoQuestion::class,
            'question' => 'Is it urgent ?',
        ],
        'deadline' => [
            'class' => DeadlineQuestion::class,
            'question' => 'When is the deadline ?',
        ],
    ];

    private array $questions = [];

    public function __construct()
    {
        $questions = [];
        foreach (self::QUESTIONS as $key => $question) {
            $questions[$key] = new $question['class']($question['question']);
        }
        $this->questions = $questions;
    }

    public function receiveQuestions()
    {
        return $this->questions;
    }

    public function sendAnswers(array $questions)
    {
        $this->questions = $questions;
    }
}
