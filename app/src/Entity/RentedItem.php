<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class RentedItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="rentedItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private Booking $booking;

    /**
     * @ORM\ManyToOne(targetEntity=RentItem::class, inversedBy="rentedItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private RentItem $item;

    /**
     * @ORM\Column(type="integer")
     */
    private int $quantity = 1;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBooking(): Booking
    {
        return $this->booking;
    }

    public function setBooking(Booking $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function getItem(): RentItem
    {
        return $this->item;
    }

    public function setItem(RentItem $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
