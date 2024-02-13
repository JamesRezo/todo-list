<?php

namespace Jamesrezo\TodoList\Todo;

use Jamesrezo\TodoList\EisenhowerMethod\TaskInterface;

interface TodoTaskInterface extends TaskInterface
{
    public function getName(): string;
}