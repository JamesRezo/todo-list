<?php

namespace Jamesrezo\TodoList\Todo;

class Team
{
    public string $name;

    public ?User $leader;

    /** @var User[] */
    public array $members = [];

    /** @var Team[] */
    public array $subTeams = [];
}
