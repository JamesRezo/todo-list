<?php

namespace Jamesrezo\TodoList\Todo;

use Jamesrezo\TodoList\Todo\Exception\NotFoundUserException;

/**
 * How to represent a fellow/comrade.
 * 
 * @author JamesRezo <james@rezo.net>
 */
class User
{
    public string $name;

    /** @var Team[] */
    public array $teams = [];

    public function isIn(Team $team): bool
    {
        return \in_array($team, $this->teams);
    }

    /**
     * @internal Nobody adds a team. It is welcome by a team.
     * 
     * @see Team::welcomes()
     */
    public function addTeam(Team $team): self
    {
        if (!$this->isIn($team)) {
            $this->teams[] = $team;
        }

        return $this;
    }

    public function leaveTeam(Team $team): self
    {
        if ($this->isIn($team)) {
            $team->remove($this);
            $offset = \array_search($team, $this->teams);

            \array_splice($this->teams, $offset, 1);

            return $this;
        }

        throw new NotFoundUserException('User not found');
    }
}
