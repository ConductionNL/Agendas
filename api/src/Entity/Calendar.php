<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Calendar is a collection of events tied to an unque person or resource.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CalendarRepository")
 */
class Calendar
{
    /**
     * @var UuidInterface The UUID identifier of this resource
     *
     * @example e2984465-190a-4562-829e-a8cca81aa35d
     *
     * @Assert\Uuid
     * @Groups({"read"})
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @var string The name of this Calendar
     *
     * @example My Calendar
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string An short description of this Calenda
     *
     * @example This is the best Calendar ever
     *
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var array Events that belong to this Calendar
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="calendar", orphanRemoval=true)
     */
    private $events;

    /**
     * @var array Schedules that belong to this Calendar
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Schedule", mappedBy="calendar", orphanRemoval=true)
     */
    private $schedules;

    /**
     * @var string The time zone of this calendar
     *
     * @example CET
     *
     * @Assert\NotNull
     * @Assert\Length(
     *      min = 3,
     *      max = 5
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=5)
     */
    private $timeZone;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Freebusy", mappedBy="calendar")
     * @MaxDepth(1)
     */
    private $freebusies;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Journal", mappedBy="calendar")
     * @MaxDepth(1)
     */
    private $journals;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Todo", mappedBy="calendar")
     * @MaxDepth(1)
     */
    private $todos;

    public function __construct()
    {
        $this->schedules = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->freebusies = new ArrayCollection();
        $this->journals = new ArrayCollection();
        $this->todos = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setCalendar($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getCalendar() === $this) {
                $event->setCalendar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Schedule[]
     */
    public function getSchedules(): Collection
    {
        return $this->schedules;
    }

    public function addSchedule(Schedule $schedule): self
    {
        if (!$this->schedules->contains($schedule)) {
            $this->schedules[] = $schedule;
            $schedule->setCalendar($this);
        }

        return $this;
    }

    public function removeSchedule(Schedule $schedule): self
    {
        if ($this->schedules->contains($schedule)) {
            $this->schedules->removeElement($schedule);
            // set the owning side to null (unless already changed)
            if ($schedule->getCalendar() === $this) {
                $schedule->setCalendar(null);
            }
        }

        return $this;
    }

    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    public function setTimeZone(string $timeZone): self
    {
        $this->timeZone = $timeZone;

        return $this;
    }

    /**
     * @return Collection|Freebusy[]
     */
    public function getFreebusies(): Collection
    {
        return $this->freebusies;
    }

    public function addFreebusy(Freebusy $freebusy): self
    {
        if (!$this->freebusies->contains($freebusy)) {
            $this->freebusies[] = $freebusy;
            $freebusy->setCalendar($this);
        }

        return $this;
    }

    public function removeFreebusy(Freebusy $freebusy): self
    {
        if ($this->freebusies->contains($freebusy)) {
            $this->freebusies->removeElement($freebusy);
            // set the owning side to null (unless already changed)
            if ($freebusy->getCalendar() === $this) {
                $freebusy->setCalendar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Journal[]
     */
    public function getJournals(): Collection
    {
        return $this->journals;
    }

    public function addJournal(Journal $journal): self
    {
        if (!$this->journals->contains($journal)) {
            $this->journals[] = $journal;
            $journal->setCalendar($this);
        }

        return $this;
    }

    public function removeJournal(Journal $journal): self
    {
        if ($this->journals->contains($journal)) {
            $this->journals->removeElement($journal);
            // set the owning side to null (unless already changed)
            if ($journal->getCalendar() === $this) {
                $journal->setCalendar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Todo[]
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo): self
    {
        if (!$this->todos->contains($todo)) {
            $this->todos[] = $todo;
            $todo->setCalendar($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo)) {
            $this->todos->removeElement($todo);
            // set the owning side to null (unless already changed)
            if ($todo->getCalendar() === $this) {
                $todo->setCalendar(null);
            }
        }

        return $this;
    }
}
