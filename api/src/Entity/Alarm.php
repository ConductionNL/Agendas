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
 * Used to describe alarms for Events and Todos.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/alarms/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/alarms/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     },
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\AlarmRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class, properties={"event.id": "exact", "todo.id": "exact", "event.calendar.id": "exact", "todo.calendar.id": "exact"})
 */
class Alarm
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
     * @var string The name of this RequestType
     *
     * @Gedmo\Versioned
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
    private string $name;

    /**
     * @var string An short description of this Event
     *
     * @Gedmo\Versioned
     *
     * @example This is the best Event ever
     *
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @var string The summary of this event.
     *
     * @Gedmo\Versioned
     *
     * @example This is the best event ever.
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $summary;

    /**
     * @var string The action of the alarm. **AUDIO**, **DISPLAY**, **EMAIL**, **PROCEDURE**
     *
     * @Gedmo\Versioned
     *
     * @example AUDIO
     *
     * @Assert\Choice(
     *      {"AUDIO","DISPLAY","EMAIL","PROCEDURE"}
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     */
    private string $action;

    /**
     * @var DateInterval The time the alarm should trigger relative to the start time of the related event.
     *
     * @Gedmo\Versioned
     *
     * @example PT30M
     *
     * @Assert\NotNull
     * @ORM\Column(type="dateinterval", name="alarm_trigger")
     * @Groups({"read","write"})
     */
    private DateInterval $trigger;

    /**
     * @var DateInterval The time until the alarm repeats.
     *
     * @Gedmo\Versioned
     *
     * @example PT30M
     *
     * @Assert\NotNull
     * @ORM\Column(type="dateinterval")
     * @Groups({"read","write"})
     */
    private DateInterval $duration;

    /**
     * @var int The number of times the alarm repeats.
     *
     * @Gedmo\Versioned
     *
     * @example 4
     *
     * @Assert\Type("int")
     * @ORM\Column(type="integer", name="alarm_repeat")
     * @Groups({"read","write"})
     */
    private int $repeat = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="alarms")
     * @MaxDepth(1)
     */
    private ?Event $event;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Todo", inversedBy="alarm", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private ?Todo $todo;

    /**
     * @var Datetime The moment this resource was created
     *
     * @Groups({"read"})
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $dateCreated;

    /**
     * @var Datetime The moment this resource last Modified
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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getTrigger(): ?DateInterval
    {
        return $this->trigger;
    }

    public function setTrigger(DateInterval $trigger): self
    {
        $this->trigger = $trigger;

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

    public function getRepeat(): ?int
    {
        return $this->repeat;
    }

    public function setRepeat(int $repeat): self
    {
        $this->repeat = $repeat;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }

    public function getTodo(): ?Todo
    {
        return $this->todo;
    }

    public function setTodo(?Todo $todo): self
    {
        $this->todo = $todo;

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
