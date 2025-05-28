<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\Column(length: 255, unique: true)]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $north = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $south = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $west = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $east = null;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'room')]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNorth(): ?string
    {
        return $this->north;
    }

    public function setNorth(?string $north): static
    {
        $this->north = $north;

        return $this;
    }

    public function getSouth(): ?string
    {
        return $this->south;
    }

    public function setSouth(?string $south): static
    {
        $this->south = $south;

        return $this;
    }

    public function getWest(): ?string
    {
        return $this->west;
    }

    public function setWest(?string $west): static
    {
        $this->west = $west;

        return $this;
    }

    public function getEast(): ?string
    {
        return $this->east;
    }

    public function setEast(?string $east): static
    {
        $this->east = $east;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setRoom($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getRoom() === $this) {
                $item->setRoom(null);
            }
        }

        return $this;
    }
}
