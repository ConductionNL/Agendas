<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateInterval;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This entity checks if a person is free or busy for a event.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/freebusy/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/freebusy/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     },
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\FreebusyRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class, properties={"calendar.id": "exact", "calendar.resource": "exact"})
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
    private UuidInterface $id;
    /**
     * @var string An short description of this Event
     *
     * @example This is the best Event ever
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @var string The urls of the attendees of this event.
     *
     * @example https://con.example.com
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Assert\Length(
     *     max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $attendee;

    /**
     * @var array The urls of the comments that belong to this event.
     *
     * @Gedmo\Versioned
     *
     * @example https://con.example.com, https://con.example2.com
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private array $comments = [];

    /**
     * @var string Url of this person
     *
     * @example https://con.example.org
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read","write"})
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $contact;

    /**
     * @var DateTime The moment this event starts
     *
     * @example 30-11-2019 15:00:00
     * @Gedmo\Versioned
     *
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $startDate;

    /**
     * @var DateTime The moment this event ends
     *
     * @example 3-11-2019 20:00:00
     * @Gedmo\Versioned
     *
     * @Assert\NotNull
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $endDate;

    /**
     * @var DateInterval The duration of this event.
     *
     * @example 2
     * @Gedmo\Versioned
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="string", nullable=true)
     */
    private ?DateInterval $duration;

    /**
     * @var string The organiser of this event linked to with an url.
     *
     * @example conduction.nl
     * @Gedmo\Versioned
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $organiser;
    /**
     * @var string The determination of the type freebusy. **FREE**, **BUSY**
     * @Gedmo\Versioned
     *
     * @example FREE
     * @Assert\Choice({"FREE","BUSY"})
     * @Groups({"read","write"})
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $freebusy;

    /**
     * @var string A specific commonground resource
     *
     * @example https://wrc.zaakonline.nl/organisations/16353702-4614-42ff-92af-7dd11c8eef9f
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $resource = null;

    /**
     * @ApiSubresource(maxDepth=1)
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="freebusies")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Calendar $calendar = null;

    /**
     * @ApiSubresource(maxDepth=1)
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedule", inversedBy="freebusies")
     */
    private ?Schedule $schedule;

    /**
     * @var DateTime The moment this resource was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $dateCreated;

    /**
     * @var DateTime The moment this resource last Modified
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $dateModified;

    public function getId(): ?Uuid
    {
        return $this->id;
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

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

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

    public function setContact(string $contact): ?string
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

    public function getDuration(): ?DateInterval
    {
        return $this->duration;
    }

    public function setDuration(DateInterval $duration): self
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

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(\DateTimeInterface $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}
