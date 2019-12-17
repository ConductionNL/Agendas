<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This entity checks if a person is free or busy for a event.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\FreebusyRepository")
 */
class Freebusy
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
     * @todo Automated ?
     * @var string The url of this event.
     * @example conduction.nl
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @var string An short description of this Event
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
     * @var string The urls of the attendees of this event.
     * @example https://con.example.com
     *
     * @Assert\Url
     * @Assert\Length(
     *     max = 255
     * )
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $attendee;

    /**
     * @var array The urls of the comments that belong to this event.
     * @example https://con.example.com, https://con.example2.com
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="array")
     */
    private $comments = [];

    /**
     * @var string Url of this person
     * @example https://con.example.org
     *
     * @Assert\NotNull
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="string")
     */
    private $contact;

    /**
     * @var DateTime The moment this event starts
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
     * @example 3-11-2019 20:00:00
     *
     * @Assert\DateTime
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @todo Automated ?
     * @var string The duration of this event.
     * @example 2
     *
     * @Assert\Type("int")
     * @Assert\NotBlank
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @var string The organiser of this event linked to with an url.
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
     * @var string The determination of the type freebusy.
     * @example FREE
     *
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="string")
     */
    private $freebusy;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="freebusies")
     * @ORM\JoinColumn(nullable=false)
     * @MaxDepth(1)
     */
    private $calendar;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedule", inversedBy="freebusies")
     * @MaxDepth(1)
     */
    private $schedule;


    public function getId(): ?string
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAttendee(): ?string
    {
        return $this->attendee;
    }

    public function setAttendee(string $attendee): self
    {
        $this->attendee = $attendee;

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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

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

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

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

    public function getFreebusy(): ?string
    {
        return $this->freebusy;
    }

    public function setFreebusy(string $freebusy): self
    {
        $this->freebusy = $freebusy;

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
