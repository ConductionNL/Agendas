<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\Journal;
use App\Entity\Todo;
use Doctrine\ORM\EntityManagerInterface;

class CalendarService
{
    public function calculateDuration(\DateTimeInterface $startDate, \DateTimeInterface $endDate)
    {
        return $startDate->diff($endDate);
    }

    public function updateEvent(Event $event, string $method, EntityManagerInterface $em)
    {
        $event->setDuration($this->calculateDuration($event->getStartDate(), $event->getEndDate()));
        if ($method == 'PUT') {
            $event->setSeq($event->getSeq() + 1);
        }
        $em->persist($event);
        $em->flush();

        return $event;
    }

    public function updateTodo(Todo $todo, string $method, EntityManagerInterface $em)
    {
        $todo->setDuration($this->calculateDuration($todo->getStartDate(), $todo->getEndDate()));
        if ($method == 'PUT') {
            $todo->setSeq($todo->getSeq() + 1);
        }
        $em->persist($todo);
        $em->flush();

        return $todo;
    }

    public function updateJournal(Journal $joural, string $method, EntityManagerInterface $em)
    {
        $joural->setDuration($this->calculateDuration($joural->getStartDate(), $joural->getEndDate()));
        if ($method == 'PUT') {
            $joural->setSeq($joural->getSeq() + 1);
        }
        $em->persist($joural);
        $em->flush();

        return $joural;
    }
}
