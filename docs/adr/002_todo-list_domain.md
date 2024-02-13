# TodoList Domain

Status: draft

Deciders: JamesRezo

Date: 2024-02-11

## Context

Version: 0.1

## Rationale

- TodoTask is a Task with a name. it MUST be a decorator of EisenhowerMethod Task
- TodoList is a collection of TodoTask
- User with a name and its teams.
- Team with a name, a leader (leaders?), members, a super-team if a unit and units(aka sub-teams)

## Opinion

- Depends on EisenhowerMethod and PHP only.
- User
  - User MAY leave a Team
- Team
  - User MUST NOT add a team for itself
  - Team MAY welcome a User as a member
  - Team MAY choose a member as a leader
  - Team MUST NOT remove a User
  - Team MAY have units(Team)
  - unit members MUST be members of the super-team
- TodoTask
  - TodoTask is a DTO
- TodoList
  - Todolist MAY be filled with an arbitrary number of TodoTask from anywhere at runtime
  - You MAY add a TodoTask in a TodoList
  - You MAY pick the first Task from a TodoList
  - You MAY postpone a Task from a TodoList
  - You MAY complete/drop  a Task from a TodoList
  - You MAY get filtered TodoList (mine, backlog) from a Todolist
  - You MAY delegate Task from a TodoList to another TodoList
  - You MAY reprioritize a Task from a TodoList
