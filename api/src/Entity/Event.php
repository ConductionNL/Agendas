<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An event happening at a certain time and location, such as a concert, lecture, meeting or festival.
 *
 * @ApiResource(
 * 	   iri="https://schema.org/Event",
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @var UuidInterface The UUID identifier of this resource
     *
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
     * @var string The name of this RequestType
     *
     * @example My RequestType
     *
     * @ApiProperty(
     * 	   iri="http://schema.org/name",
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The name of this RequestType",
     *             "type"="string",
     *             "example"="My RequestType",
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
     * @var string An short description of this Event
     *
     * @example This is the best Event ever
     *
     * @ApiProperty(
     * 	   iri="https://schema.org/description",
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "An short description of this Event",
     *             "type"="string",
     *             "example"="This is the best Event ever",
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

    /**     *
     * @var Datetime The moment this event starts
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $from;

    /**
     * @var Datetime The moment this event ends
     *
     * @Groups({"read","write"})
     * @ORM\Column(type="datetime")
     */
    private $till;

    /**
     * @var string The location of this event
     *
     * @example Dam 1, Amsterdam
     *
     * @ApiProperty(
     * 	   iri="https://schema.org/location",
     *     attributes={
     *         "swagger_context"={
     *         	   "description" = "The location of this event",
     *             "type"="string",
     *             "example"="Dam 1, Amsterdam",
     *             "maxLength"="255",
     *         }
     *     }
     * )
     *
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @var string An optional Schedule to wich this event belongs
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Schedule", inversedBy="events")
     */
    private $schedule;

    /**
     * @var string The Calendar to wich this event belongs
     *
     * @MaxDepth(1)
     * @Groups({"read","write"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $calendar;

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

    public function getFrom(): ?\DateTimeInterface
    {
        return $this->from;
    }

    public function setFrom(\DateTimeInterface $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getTill(): ?\DateTimeInterface
    {
        return $this->till;
    }

    public function setTill(\DateTimeInterface $till): self
    {
        $this->till = $till;

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

    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    public function setSchedule(?Schedule $schedule): self
    {
        $this->schedule = $schedule;

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
