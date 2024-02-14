# TodoList Domain

Status: draft

Deciders: JamesRezo

Date: 2024-02-13

## Context

Version: 0.1

## Opinion

- phpunit/phpunit
- league/csv
- symfony/console
- symfony/var-dumper

```tree
tests/
├── EisenhowerMethod
│   ├── Functional // or Behavior
│   └── Unit
├── Todo
│   ├── Fixtures
│   │   ├── TeamRepository.php
│   │   ├── TodoTaskRepository.php
│   │   ├── UserRepository.php
│   │   └── data
│   │       ├── team.csv
│   │       ├── team_user.csv
│   │       ├── todotask.csv
│   │       └── user.csv
│   ├── Functional // or Behavior
│   └── Unit
```
