<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\MaxDepth;

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
	 * @var UuidInterface $id The UUID identifier of this resource
	 * @example e2984465-190a-4562-829e-a8cca81aa35d
	 *
	 * @ApiProperty(
	 * 	   identifier=true,
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The UUID identifier of this resource",
	 *             "type"="string",
	 *             "format"="uuid",
	 *             "example"="e2984465-190a-4562-829e-a8cca81aa35d"
	 *         }
	 *     }
	 * )
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
	 * @var string $name The name of this Schedule
	 * @example My Schedule
	 *
	 * @ApiProperty(
	 * 	   iri="http://schema.org/name",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "The name of this Schedule",
	 *             "type"="string",
	 *             "example"="My Schedule",
	 *             "maxLength"="255",
	 *             "required" = true
	 *         }
	 *     }
	 * )
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
	 * @var string $description An short description of this Schedule
	 * @example This is the best Schedule ever
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/description",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "An short description of this Schedule",
	 *             "type"="string",
	 *             "example"="This is the best Schedule ever",
	 *             "maxLength"="2550"
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\Length(
	 *      max = 2550
	 * )
	 * @Groups({"read","write"})
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;


    /**
	 * @var string $byDay Defines the day(s) of the week on which a recurring Event takes place. Sunday is both 0 and 7.
	 * @example 1
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/byDay",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the day(s) of the week on which a recurring Event takes place. Sunday is both 0 and 7",
	 *             "type"="integer",
	 *             "example"="1",
	 *             "minimum"="0",
	 *             "maximum"="7",
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\PositiveOrZero
	 * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byDay;

    /**
	 * @var string $byMonth Defines the month(s) of the year on which a recurring Event takes place. Specified as an Integer between 1-12. January is 1.
	 * @example 1
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/byMonth",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the month(s) of the year on which a recurring Event takes place. Specified as an Integer between 1-12. January is 1",
	 *             "type"="integer",
	 *             "example"="1",
	 *             "minimum"="1",
	 *             "maximum"="12",
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\PositiveOrZero
	 * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byMonth;

    /**
	 * @var string $byMonthDay Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31.
	 * @example 1
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/byMonthDay",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31",
	 *             "type"="integer",
	 *             "example"="1",
	 *             "minimum"="1",
	 *             "maximum"="31",
	 *         }
	 *     }
	 * )
	 *
	 * @Assert\PositiveOrZero
	 * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $byMonthDay;

    /**
	 * @var string $events The that belong to or are coused by this Schedule
	 *
     * @MaxDepth(1)
	 * @Groups({"read","write"})
     * @ORM\OneToMany(targetEntity="App\Entity\Event", mappedBy="schedule")
     */
    private $events;

    /**
	 * @var string $byMonthDay Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31.
	 * @example ['2019-10-22T17:32:20Z','2019-10-22T17:32:20Z']
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/exceptDate",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the day(s) of the month on which a recurring Event takes place. Specified as an Integer between 1-31",
	 *             "type"="array",
	 *             "example"="['2019-10-22T17:32:20Z','2019-10-22T17:32:20Z']"
	 *         }
	 *     }
	 * )
	 *
	 * @Groups({"read","write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $exceptDates = [];

    /**
	 * @var integer $repeatCount Defines the number of times a recurring Event will take place
	 * @example
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/repeatCount",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the number of times a recurring Event will take plac",
	 *             "type"="integer",
	 *             "example"="1",
	 *         }
	 *     }
	 * )
	 *
	 * @Groups({"read","write"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $repeatCount;

    /**
	 * @var string $repeatFrequency Defines the frequency at which Events will occur according to a schedule Schedule. The intervals between events should be defined as a [Duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) of time.
	 * @example PT1M
	 *
	 * @ApiProperty(
	 * 	   iri="https://schema.org/repeatFrequency",
	 *     attributes={
	 *         "swagger_context"={
	 *         	   "description" = "Defines the frequency at which Events will occur according to a schedule Schedule. The intervals between events should be defined as a [Duration](https://en.wikipedia.org/wiki/ISO_8601#Durations) of time",
	 *             "type"="string",
	 *             "example"="PT1M",
	 *         }
	 *     }
	 * )
	 *
	 * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $repeatFrequency;

    /**
	 * @var string $calendar The Calendar to wich this Schedule belongs
	 *
     * @MaxDepth(1)
	 * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="schedules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $calendar;

    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
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
}
