<?php

namespace Jamesrezo\TodoList\EisenhowerMethod;

use DateInterval;
use DateTimeImmutable;
use Jamesrezo\TodoList\EisenhowerMethod\Exception\MissingDeadlineException;

/**
 * Create a Task non-interactively.
 * 
 * @author JamesRezo <james@rezo.net>
 */
class TaskFactory
{
    /**
     * Create a Task non-interactively.
     *
     * @throws MissingDeadlineException
     */
    public static function createTask(bool $important, bool $urgent, ?DateInterval $deadline = null): Task
    {
        $decision = new Decision;

        $i = 0;
        while ($decision->condition()) {
            if ($i == 0) {
                $decision->registerAnswer($important);
            }
            
            if ($i == 1) {
                $decision->registerAnswer($urgent);
            }
        
            if ($i == 2) {
                if (\is_null($deadline)) {
                    throw new MissingDeadlineException('Deadline is missging');
                }
    
                $decision->registerAnswer((new DateTimeImmutable())->add($deadline));
            }

            $i++;
        }

        return $decision->deliver();
    }
}
