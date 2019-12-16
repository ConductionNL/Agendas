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
 * A schedule defines a repeating time period used to describe a regularly occurring Event. At a minimum a schedule will specify repeatFrequency which describes the interval between occurences of the event. Additional information can be provided to specify the schedule more precisely. This includes identifying the day(s) of the week or month when the recurring event will take place, in addition to its start and end time. Schedules may also have start and end dates to indicate when they are active, e.g. to define a limited calendar of events.
 *
 * @ApiResource(
 * 	   iri="http://schema.org/PostalAddress",
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
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
     * @var string The name of this Schedule
     *
     * @example My Schedule
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
     * @var string An short description of this Schedule
     *
     * @example This is the best Schedule ever
     *
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string Defines the day(s) of the week on which a recurring Event takes place. Sunday is both 0 and 7.
     *
     * @example 1
     *
     * @Assert\Range(
     *     min = 0,
     *     max = 7
     * )
     * @Assert\PositiveOrZero
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byDay;

    /**
     * @var string Defines the month(s) of the year on which a recurring Event takes place. Specified as an Integer between 1-12. January is 1.
     *
     * @example 1
     *
     * @Assert\Range(
     *     min = 1,
     *     max = 12
     * )
     * @Assert\PositiveOrZero
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byMonth;

    /**
     * @var string Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31.
     *
     * @example 1
     *
     * @Assert\Range(
     *     min = 1,
     *     max = 31
     * )
     * @Assert\PositiveOrZero
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byMonthDay;

    /**
     * @var string The that belong to or are coused by this Schedule
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="schedule")
     */
    private $events;

    /**
     * @var string Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31.
     *
     * @example 30
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $exceptDates = [];

    /**
     * @var int Defines the number of times a recurring Event will take place
     *
     * @example 10
     *
     * @Assert\Type("integer")
     * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $repeatCount;

    /**
     * @var string Defines the frequency at which Events will occur according to a schedule Schedule. The intervals between events should be defined as a [Duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) of time.
     *
     * @example PT1M
     *
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $repeatFrequency;

    /**
     * @var string The Calendar to wich this Schedule belongs
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $calendar;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Freebusy", mappedBy="schedule")
     * @MaxDepth(1)
     */
    private $freebusies;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Todo", mappedBy="schedule")
     * @MaxDepth(1)
     */
    private $todos;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->freebusies = new ArrayCollection();
        $this->todos = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function getByDay(): ?int
    {
        return $this->byDay;
    }

    public function setByDay(?int $byDay): self
    {
        $this->byDay = $byDay;

        return $this;
    }

    public function getByMonth(): ?int
    {
        return $this->byMonth;
    }

    public function setByMonth(?int $byMonth): self
    {
        $this->byMonth = $byMonth;

        return $this;
    }

    public function getByMonthDay(): ?int
    {
        return $this->byMonthDay;
    }

    public function setByMonthDay(?int $byMonthDay): self
    {
        $this->byMonthDay = $byMonthDay;

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
            $event->setSchedule($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            // set the owning side to null (unless already changed)
            if ($event->getSchedule() === $this) {
                $event->setSchedule(null);
            }
        }

        return $this;
    }

    public function getExceptDates(): ?array
    {
        return $this->exceptDates;
    }

    public function setExceptDates(?array $exceptDates): self
    {
        $this->exceptDates = $exceptDates;

        return $this;
    }

    public function getRepeatCount(): ?int
    {
        return $this->repeatCount;
    }

    public function setRepeatCount(?int $repeatCount): self
    {
        $this->repeatCount = $repeatCount;

        return $this;
    }

    public function getRepeatFrequency(): ?string
    {
        return $this->repeatFrequency;
    }

    public function setRepeatFrequency(?string $repeatFrequency): self
    {
        $this->repeatFrequency = $repeatFrequency;

        return $this;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function setCalendar(?Calendar $calendar): self
    {
        $this->calendar = $calendar;

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
            $freebusy->setSchedule($this);
        }

        return $this;
    }

    public function removeFreebusy(Freebusy $freebusy): self
    {
        if ($this->freebusies->contains($freebusy)) {
            $this->freebusies->removeElement($freebusy);
            // set the owning side to null (unless already changed)
            if ($freebusy->getSchedule() === $this) {
                $freebusy->setSchedule(null);
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
            $todo->setSchedule($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): self
    {
        if ($this->todos->contains($todo)) {
            $this->todos->removeElement($todo);
            // set the owning side to null (unless already changed)
            if ($todo->getSchedule() === $this) {
                $todo->setSchedule(null);
            }
        }

        return $this;
    }
}
