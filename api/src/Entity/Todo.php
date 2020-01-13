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
 * A to-do from an event.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Todo
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
     * @var string The name of this RequestType
     *
     * @example My RequestType
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
     * @var string An short description of this Event
     *
     * @example This is the best Event ever
     *
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var DateTime The moment this event starts
     *
     * @example 30-11-2019 15:00:00
     *
     * @Assert\DateTime
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @var Datetime The moment this event ends
     *
     * @example 3-11-2019 20:00:00
     *
     * @Assert\DateTime
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @var string The location of this event
     *
     * @example Dam 1, Amsterdam
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @var string The security class of this event.
     *
     * @example PUBLIC
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $class;

    /**
     * @todo Automated ?
     *
     * @var string The creation in datetime of this event.
     *
     * @example 16-12-2019 15:08:26
     *
     * @Assert\DateTime
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var string The coordinates of this event.
     *
     * @example 81.15147,10.36374,42.26
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $geo;

    /**
     * @todo Automated ?
     *
     * @var datetime The last modification of this event in datetime.
     *
     * @example 16-12-2019 15:14:34
     *
     * @Assert\DateTime
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $lastMod;

    /**
     * @var string The organiser of this event linked to with an url.
     *
     * @example conduction.nl
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $organiser;

    /**
     * @var string The status of this evemt.
     *
     * @example Confirmed
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @var string The summary of this event.
     *
     * @example This is the best event ever.
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $summary;

    /**
     * @todo Automated ?
     *
     * @var string The url of this event.
     *
     * @example conduction.nl
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @todo Automated ?
     *
     * @var string The duration of this event.
     *
     * @example 2
     *
     * @Assert\Type("int")
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @var string Url of this person
     *
     * @example https://con.example.org
     *
     * @Assert\NotNull
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="string")
     */
    private $contact;

    /**
     * @todo Automated ?
     *
     * @var int The version number of this event.
     *
     * @example 1.0
     *
     * @Assert\Type("int")
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $seq;
    /**
     * @var int The priority of this event ranging from 1 (high) to 9 (low).
     *
     * @example 1
     *
     * @Assert\Type("int")
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $priority;

    /**
     * @var array The urls of the attendees of this event.
     *
     * @example https://con.example.com, https://con.example2.com
     *
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="array")
     */
    private $attendees = [];

    /**
     * @var array The urls of the attachments of this event.
     *
     * @example https://example.org, https://example2.org
     *
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="array")
     */
    private $attachments = [];

    /**
     * @var array The urls of the catergories this event belongs to.
     *
     * @example https://con.example.com, https://con.example2.com
     *
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="array")
     */
    private $categories = [];

    /**
     * @var array The urls of the comments that belong to this event.
     *
     * @example https://con.example.com, https://con.example2.com
     *
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="array")
     */
    private $comments = [];

    /**
     * @var datetime The date and time a to-do is completed.
     *
     * @example 10-12-2019 15:00:00
     *
     * @Assert\NotNull
     * @Assert\DateTime
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $completed;

    /**
     * @var int The percentage of a to-do that has been comepleted.
     *
     * @example 40%
     *
     * @Assert\Type("int")
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $percentageDone;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToMany(targetEntity="App\Entity\Resource", mappedBy="todos")
     * @MaxDepth(1)
     */
    private $resources;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Alarm", mappedBy="todo", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $alarm;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="todos")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $calendar;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedule", inversedBy="todos")
     * @MaxDepth(1)
     */
    private $schedule;

    public function __construct()
    {
        $this->resources = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getCreated(): ?string
    {
        return $this->created;
    }

    public function setCreated(string $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getGeo(): ?string
    {
        return $this->geo;
    }

    public function setGeo(string $geo): self
    {
        $this->geo = $geo;

        return $this;
    }

    public function getLastMod(): ?string
    {
        return $this->lastMod;
    }

    public function setLastMod(string $lastMod): self
    {
        $this->lastMod = $lastMod;

        return $this;
    }

    public function getOrganiser(): ?string
    {
        return $this->organiser;
    }

    public function setOrganiser(string $organiser): self
    {
        $this->organiser = $organiser;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): ?string
    {
        $this->contact = $contact;

        return $this;
    }

    public function getSeq(): ?int
    {
        return $this->seq;
    }

    public function setSeq(int $seq): self
    {
        $this->seq = $seq;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAttendees(): ?array
    {
        return $this->attendees;
    }

    public function setAttendees(array $attendees): self
    {
        $this->attendees = $attendees;

        return $this;
    }

    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    public function setAttach(array $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function getCategories(): ?array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function setComments(array $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getCompleted(): ?\DateTimeInterface
    {
        return $this->completed;
    }

    public function setCompleted(\DateTimeInterface $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getPercentageDone(): ?int
    {
        return $this->percentageDone;
    }

    public function setPercentageDone(int $percentageDone): self
    {
        $this->percentageDone = $percentageDone;

        return $this;
    }

    /**
     * @return Collection|resource[]
     */
    public function getResources(): Collection
    {
        return $this->resources;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resources->contains($resource)) {
            $this->resources[] = $resource;
            $resource->addTodo($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resources->contains($resource)) {
            $this->resources->removeElement($resource);
            $resource->removeTodo($this);
        }

        return $this;
    }

    public function getAlarm(): ?Alarm
    {
        return $this->alarm;
    }

    public function setAlarm(?Alarm $alarm): self
    {
        $this->alarm = $alarm;

        // set (or unset) the owning side of the relation if necessary
        $newTodo = $alarm === null ? null : $this;
        if ($newTodo !== $alarm->getTodo()) {
            $alarm->setTodo($newTodo);
        }

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

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedule $schedule): self
    {
        $this->schedule = $schedule;

        return $this;
    }
}
