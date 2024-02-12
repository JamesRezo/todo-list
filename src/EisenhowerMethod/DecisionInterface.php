<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use Jamesrezo\TodoList\EisenhowerMethod\Internal\Interaction;

interface DecisionInterface
{
    public function getInteraction(): Interaction;

    public function compute(): self;
    
    public function deliver(): Task;

    public function needDeadline(bool $important, bool $urgent): bool;
}
