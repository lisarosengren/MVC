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
    /**
     * The name of the Room.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Id]
    #[ORM\Column(length: 255, unique: true, nullable: false)]
    private string $id = "";

    /**
     * The image string of the Room.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(length: 255, nullable: false)]
    private string $image = "";

    /**
     * The description of the Room.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(length: 255, nullable: false)]
    private string $description = "";

    /**
     * If the Room is the start room.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(nullable: false)]
    private bool $start = false;


    /**
     * The items connected to the Room.
     * @var Collection<int, Item>
     */
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'room')]
    private Collection $items;



    /**
     * The Room connected to the exit.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Room $north = null;

    /**
     * The Room connected to the exit.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Room $south = null;

    /**
     * The Room connected to the exit.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Room $west = null;

    /**
     * The Room connected to the exit.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Room $east = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }


    /**
     * Get the name of the Room
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get the image string of the Room.
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
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

    public function isStart(): bool
    {
        return $this->start;
    }

    public function getNorth(): ?Room
    {
        return $this->north;
    }

    public function getSouth(): ?Room
    {
        return $this->south;
    }

    public function getWest(): ?Room
    {
        return $this->west;
    }

    public function getEast(): ?Room
    {
        return $this->east;
    }

    /**
     * @return array <string, Room>
     */

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
