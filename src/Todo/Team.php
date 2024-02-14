<?php

namespace Jamesrezo\TodoList\Todo;

use Jamesrezo\TodoList\Todo\Exception\NotFoundUserException;

/**
 * @author JamesRezo <james@rezo.net>
 */
class Team
{
    public string $name;

    public ?User $leader;

    /** @var User[] */
    public array $members = [];

    public ?Team $superTeam = null;

    /** @var Team[] */
    public array $units = [];

    public function hasMember(User $user): bool
    {
        return \in_array($user, $this->members);
    }

    public function welcomes(User $user): self
    {
        if (!$this->hasMember($user)) {
            $user->addTeam($this);
            $this->members[] = $user;
        }

        return $this;
    }

    public function choosesAsLeader(User $user): self
    {
        if ($this->hasMember($user)) {
            $this->leader = $user;

            return $this;
        }

        throw new NotFoundUserException('User not found');
    }

    /**
     * @internal No team removes a member, a team looses a member when it decides to leave
     *
     * @see User::leaveTeam()
     */
    public function removes(User $user): self
    {
        if ($this->hasMember($user)) {
            $offset = \array_search($user, $this->members);

            \array_splice($this->members, $offset, 1);
            if ($user == $this->leader) {
                $this->leader = null;
            }

            return $this;
        }

        throw new NotFoundUserException('User not found');
    }
}
