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
  - Ike says : "Find someone else, then drop it" (urgent) or "Just drop it" (not-urgent) when it is not important for you
