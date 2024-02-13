<?php

namespace Jamesrezo\TodoList\Todo;

class User
{
    public string $name;

    /** @var Team[] */
    public array $teams = [];
}
