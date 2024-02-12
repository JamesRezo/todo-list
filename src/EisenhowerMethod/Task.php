<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateTimeImmutable;
use Jamesrezo\TodoList\EisenhowerMethod\Task\Who;

/**
 * Use Decorators to extend the behavior
 * 
 * @author JamesRezo <james@rezo.net>
 */
final readonly class Task
{
    public function __construct(
        public Who $who,
        public ?DateTimeImmutable $when,
        public ?string $ikeSays,
    ) {
    }
}
