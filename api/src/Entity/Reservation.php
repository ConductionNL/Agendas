<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A Reservation is a event that is tied to an unique person or resource.
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"write"}, "enable_max_depth"=true},
 *     itemOperations={
 *          "get",
 *          "put",
 *          "delete",
 *          "get_change_logs"={
 *              "path"="/calendars/{id}/change_log",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Changelogs",
 *                  "description"="Gets al the change logs for this resource"
 *              }
 *          },
 *          "get_audit_trail"={
 *              "path"="/calendars/{id}/audit_trail",
 *              "method"="get",
 *              "swagger_context" = {
 *                  "summary"="Audittrail",
 *                  "description"="Gets the audit trail for this resource"
 *              }
 *          }
 *     },
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 * @Gedmo\Loggable(logEntryClass="Conduction\CommonGroundBundle\Entity\ChangeLog")
 *
 * @ApiFilter(BooleanFilter::class)
 * @ApiFilter(OrderFilter::class)
 * @ApiFilter(DateFilter::class, strategy=DateFilter::EXCLUDE_NULL)
 * @ApiFilter(SearchFilter::class, properties={"underName": "exact", "provider": "exact"})
 *
 * })
 */
class Reservation
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
     * @var string The name of this Reservation
     *
     * @example My Reservation
     * @Assert\NotNull
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var string An short description of this Reservation
     *
     * @example This is the best Reservation ever
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

    /**
     * @var string The url of a person who is under name(the requester) of this reservation
     *
     * @example https://person/1
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private string $underName;

    /**
     * @var int The number of participants for this reservation
     *
     * @Gedmo\Versioned
     *
     * @example 1
     *
     * @Assert\Type("int")
     * @Groups({"read","write"})
     * @ORM\Column(type="integer")
     */
    private int $numberOfParticipants;

    /**
     * @var Event Event that is booked in this reservation
     *
     * @Groups({"read","write"})
     * @MaxDepth(1)
     * @ORM\OneToOne(targetEntity=Event::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Event $event;

    /**
     * @var string The url of a person or organization who is the provider of this reservation
     *
     * @example https://organization/1
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255)
     */
    private string $provider;

    /**
     * @var string The url of a person or organization who is the broker of this reservation
     *
     * @example https://person/1
     *
     * @Gedmo\Versioned
     * @Assert\Url
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $broker;

    /**
     * @var string The thing -- flight, event, restaurant,etc. being reserved
     *
     * @example Restaurant
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reservationFor;

    /**
     * @var string The current status of the reservation.
     *
     * @example Complete
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reservationStatus;

    /**
     * @var string A ticket associated with the reservation.
     *
     * @example Complete
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reservedTicket;

    /**
     * @var string Any membership in a frequent flyer, hotel loyalty program, etc. being applied to the reservation.
     *
     * @example Complete
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 255
     * )
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $programMembershipUsed;

    /**
     * @var string The currency of this product in an [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) format
     *
     * @example EUR
     *
     * @Gedmo\Versioned
     * @Assert\Currency
     * @Groups({"read", "write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $priceCurrency;

    /**
     * @var string The total price of this reservation
     *
     * @example 50.00
     *
     * @Gedmo\Versioned
     * @Groups({"read", "write"})
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private ?string $totalPrice;

    /**
     * @var string comment for this reservation
     *
     * @example We would like a table with sight at the sea
     *
     * @Gedmo\Versioned
     * @Assert\Length(
     *      max = 2550
     * )
     * @Groups({"read","write"})
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $comment;

    public function getId(): ?Uuid
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

    public function getUnderName(): ?string
    {
        return $this->underName;
    }

    public function setUnderName(?string $underName): self
    {
        $this->underName = $underName;

        return $this;
    }

    public function getNumberOfParticipants(): ?int
    {
        return $this->numberOfParticipants;
    }

    public function setNumberOfParticipants(?int $numberOfParticipants): self
    {
        $this->numberOfParticipants = $numberOfParticipants;

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

    public function getProvider(): ?string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getBroker(): ?string
    {
        return $this->broker;
    }

    public function setBroker(?string $broker): self
    {
        $this->broker = $broker;

        return $this;
    }

    public function getReservationFor(): ?string
    {
        return $this->reservationFor;
    }

    public function setReservationFor(?string $reservationFor): self
    {
        $this->reservationFor = $reservationFor;

        return $this;
    }

    public function getReservationStatus(): ?string
    {
        return $this->reservationStatus;
    }

    public function setReservationStatus(?string $reservationStatus): self
    {
        $this->reservationStatus = $reservationStatus;

        return $this;
    }

    public function getReservedTicket(): ?string
    {
        return $this->reservedTicket;
    }

    public function setReservedTicket(?string $reservedTicket): self
    {
        $this->reservedTicket = $reservedTicket;

        return $this;
    }

    public function getProgramMembershipUsed(): ?string
    {
        return $this->programMembershipUsed;
    }

    public function setProgramMembershipUsed(?string $programMembershipUsed): self
    {
        $this->programMembershipUsed = $programMembershipUsed;

        return $this;
    }

    public function getPriceCurrency(): ?string
    {
        return $this->priceCurrency;
    }

    public function setPriceCurrency(?string $priceCurrency): self
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function setTotalPrice($totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
