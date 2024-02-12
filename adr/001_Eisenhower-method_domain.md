# Eisenhower Method Domain

Status: draft

Deciders: JamesRezo

Date: 2024-02-11

## Context

Version: 0.1

## Rationale

- See the english Wikipedia [Time Management](https://en.wikipedia.org/wiki/Time_management#The_Eisenhower_Method) page.
- In french Wikipedia [Matrice d'Eisenhower](https://fr.wikipedia.org/wiki/Matrice_d'Eisenhower) page.

- Task
  - Who
    - enum
      - You when in important quadrants
      - Delegate when in not-important quadrants
  - When
    - ?DateTimeImmutable set to
      - now() when in important/urgent quadrant
      - a fixed deadline when in important/not-urgent quadrant
      - null when in not-important quadrants
  - Ike says : "Find someone else, then drop it" (urgent) or "Just drop it" (not-urgent) when it is not important for You

To compute the quadrant of a Task, You have to answer to 2 questions to make a decision.

- Is it important ? yes/no
- Is it urgent ? yes/no
- If important but not urgent, You need to answer a mandatory third question to fix a deadline.

When answer is given to all asked questions, the Task can be delivered (the decision is made).

- Decision
  - ask() Answer to 2 to 3 questions
  - a Quadrant to be computed
  - deliver() the Task
- Answer/Question
  - YesNo Question
  - Deadline Question
  - $important is the Answer to the "Is it important" Question
  - $urgent is is the Answer to the "it urgent" Question
  - $deadline is is the Answer to the "what is the deadline" Question
  - Answer is typed according to typed question
    - YesNo Question require bool Answer
    - Deadline Question require DateTimeImmutable Answer

a Decision needs:

- 2 YesNoQuestion to provide $important and $urgent Answer
- 1 DeadlineQuestion to provide $deadline Answer

- Quadrant
  - Important/Urgent quadrant tasks are done immediately and personally e.g. crises, deadlines, problems.
    - Deliver Task = Who::You, When::Now, deadline = now() -> Your TodoList
  - Important/Not Urgent quadrant tasks get an end date and are done personally, e.g. relationships, planning, recreation.
    - Deliver Task = Who::You, When::Later, deadline = now()+Interval -> Your TodoList
  - Unimportant/Urgent quadrant tasks are delegated, e.g. interruptions, meetings, activities.
    - Deliver Task = Who::Delegate, When::?, deadline = ? -> Someone else's TodoList (find which delegate, then drop Task)
  - Unimportant/Not Urgent quadrant tasks are dropped, e.g. time wasters, pleasant activities, trivia.
    - Deliver Task = Who::Delegate, When::?, deadline = ? -> Someone else's TodoList (drop the task)

- Interacton to manage interactions with a client (event bus, console command, web controller, ...)
  - receive questions in the client
  - send answers
  - a Decision should be an Interaction with same interface (Decorator)

- Ports
  - User Side
    - interface for Decision

## Opinion

- Quadrant Computing
  - needs 3 parameters : important(bool), urgent(bool), optional deadline(?DateTimeImmutable)
  - returns 1 Task
  - throws a (Business)LogicException if important && !urgent && is_null(deadline)
  - is @internal
