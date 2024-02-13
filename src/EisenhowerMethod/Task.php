<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateTimeImmutable;
use Jamesrezo\TodoList\EisenhowerMethod\Task\Who;
use Jamesrezo\TodoList\EisenhowerMethod\Exception\UnexpectedPropertyException;

/**
 * Use Decorators to extend the behavior
 * 
 * @author JamesRezo <james@rezo.net>
 */
final readonly class Task implements TaskInterface
{
    public function __construct(
        private Who $who,
        private ?DateTimeImmutable $when,
        private ?string $ikeSays,
    ) {
    }

    public function __get($name): mixed
    {
        if (!\in_array($name, ['who', 'when', 'ikeSays'])) {
            throw new UnexpectedPropertyException('Not a Task property');
        }

        return $this->$name;
    }
}
