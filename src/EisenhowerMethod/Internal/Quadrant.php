<?php

namespace Jamesrezo\TodoList\EisenhowerMethod\Internal;

use DateTimeImmutable;
use Jamesrezo\TodoList\EisenhowerMethod\Exception\MissingDeadlineException;
use Jamesrezo\TodoList\EisenhowerMethod\Task;
use Jamesrezo\TodoList\EisenhowerMethod\Task\IkeSays;
use Jamesrezo\TodoList\EisenhowerMethod\Task\Who;

/**
 * @internal Eisenhower Matrix.
 * 
 * @author JamesRezo <james@rezo.net>
 */
final class Quadrant
{
    /**
     * Eisenhower Decision Principle.
     *
     * @see https://en.wikipedia.org/wiki/Time_management#The_Eisenhower_Method
     *
     * @throws MissingDeadlineException if important, !urgent, deadline null
     */
    public static function compute(bool $important, bool $urgent, ?DateTimeImmutable $deadline): Task
    {
        if ($important) {
            if ($urgent) {
                // Important/Urgent quadrant task
                return new Task(who:Who::You, when:new DateTimeImmutable(), ikeSays:null);
            }

            // Important/Not Urgent quadrant task
            if (\is_null($deadline)) {
                throw new MissingDeadlineException('Deadline is missging');
            }

            return new Task(who:Who::You, when:$deadline, ikeSays:null);
        }

        if ($urgent) {
            // Unimportant/Urgent quadrant task
            return new Task(who:Who::Delegate, when:null, ikeSays:IkeSays::FindSomeone);
        }

        // Unimportant/Not Urgent quadrant task
        return new Task(who:Who::Delegate, when:null, ikeSays:IkeSays::DropIt);
    }
}
