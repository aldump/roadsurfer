<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $endDate;

    /**
     * @ORM\OneToMany(targetEntity=RentedItem::class, mappedBy="booking", orphanRemoval=true)
     */
    private Collection $rentedItems;

    /**
     * @ORM\ManyToOne(targetEntity=Station::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private Station $station;

    public function __construct()
    {
        $this->rentedItems = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|array<RentedItem>
     */
    public function getRentedItems(): Collection
    {
        return $this->rentedItems;
    }

    public function addRentedItem(RentedItem $rentedItem): self
    {
        if (!$this->rentedItems->contains($rentedItem)) {
            $this->rentedItems[] = $rentedItem;
            $rentedItem->setBooking($this);
        }

        return $this;
    }

    public function getStation(): Station
    {
        return $this->station;
    }

    public function setStation(Station $station): self
    {
        $this->station = $station;

        return $this;
    }
}
