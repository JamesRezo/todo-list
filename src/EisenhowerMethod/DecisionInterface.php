<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use Jamesrezo\TodoList\EisenhowerMethod\Internal\QuestionInterface;

interface DecisionInterface extends QuestionInterface
{
    public function deliver(): Task;
}
