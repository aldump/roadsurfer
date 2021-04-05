<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RentItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=RentItemRepository::class)
 */
class RentItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=RentedItem::class, mappedBy="item", orphanRemoval=true)
     * @Groups("all")
     */
    private Collection $rentedItems;

    public function __construct()
    {
        $this->rentedItems = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $rentedItem->setItem($this);
        }

        return $this;
    }
}
