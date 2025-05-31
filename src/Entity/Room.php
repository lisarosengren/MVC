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

    /**
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'room')]
    private Collection $items;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $second_description = null;

    #[ORM\Column(nullable: true)]
    private ?bool $start = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?room $north = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?room $south = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?room $west = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?room $east = null;

    #[ORM\Column(nullable: true)]
    private ?bool $visited = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $name): static
    {
        $this->id = $id;

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

    public function getSecondDescription(): ?string
    {
        return $this->second_description;
    }

    public function setSecondDescription(string $second_description): static
    {
        $this->second_description = $second_description;

        return $this;
    }

    public function isStart(): ?bool
    {
        return $this->start;
    }

    public function setStart(?bool $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getNorth(): ?room
    {
        return $this->north;
    }

    public function setNorth(?room $north): static
    {
        $this->north = $north;

        return $this;
    }

    public function getSouth(): ?room
    {
        return $this->south;
    }

    public function setSouth(?room $south): static
    {
        $this->south = $south;

        return $this;
    }

    public function getWest(): ?room
    {
        return $this->west;
    }

    public function setWest(?room $west): static
    {
        $this->west = $west;

        return $this;
    }

    public function getEast(): ?room
    {
        return $this->east;
    }

    public function setEast(?room $east): static
    {
        $this->east = $east;

        return $this;
    }

    public function isVisited(): ?bool
    {
        return $this->visited;
    }

    public function setVisited(?bool $visited): static
    {
        $this->visited = $visited;

        return $this;
    }

    public function getExits(): array
    {
        $exits = [];

        if ($this->west !== null) {
            $exits["väst"] = $this->west;
        }

        if ($this->north !== null) {
            $exits["norr"] = $this->north;
        }

        if ($this->south !== null) {
            $exits["söder"] = $this->south;
        }

        if ($this->east !== null) {
            $exits["öst"] = $this->east;
        }

        return $exits;
    }
}
