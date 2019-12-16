<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Used to describe alarms for Events and Todos.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 *     )
 * @ORM\Entity(repositoryClass="App\Repository\AlarmRepository")
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
    private $id;

    /**
     * @var string The name of this RequestType
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
     * @var string The summary of this event.
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
     * @var string The action of the alarm.
     * @example AUDIO
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     * @Groups({"read","write"})
     */
    private $action;

    /**
     * @todo Duration?
     * @var integer The time the alarm should trigger relative to the start time of the related event.
     * @example 30
     *
     * @Assert\Type("int")
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     * @Groups({"read","write"})
     */
    private $trigger;

    /**
     * @todo Duration?
     * @var integer The time until the alarm repeats.
     * @example 60
     *
     * @Assert\Type("int")
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     * @Groups({"read","write"})
     */
    private $duration;

    /**
     * @var integer The number of times the alarm repeats.
     * @example 4
     *
     * @Assert\Type("int")
     * @Assert\NotNull
     * @ORM\Column(type="integer")
     * @Groups({"read","write"})
     */
    private $repeat;

    /**
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="alarms")
     * @MaxDepth(1)
     */
    private $event;

    /**
     * @Groups({"read","write"})
     * @ORM\OneToOne(targetEntity="App\Entity\Todo", inversedBy="alarm", cascade={"persist", "remove"})
     * @MaxDepth(1)
     */
    private $todo;

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

    public function getTrigger(): ?int
    {
        return $this->trigger;
    }

    public function setTrigger(int $trigger): self
    {
        $this->trigger = $trigger;

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
}
