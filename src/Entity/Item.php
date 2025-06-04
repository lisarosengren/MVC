<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    /**
     * The name of the Item.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Id]
    #[ORM\Column(length: 25, unique: true)]
    private string $id = "";

    /**
     * The description of the Item.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(length: 255, nullable: false)]
    private string $examine = "";

    /**
     * If examining means the end of the game.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(nullable: false)]
    private bool $deadly = false;

    /**
     * If its possible to pick up item.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(nullable: false)]
    private bool $pickable = false;

    /**
     * The text after combining two items.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(name: "comb_text", length: 255, nullable: true)]
    private ?string $combText = null;

    /**
     * The room connected to the item,
     * if any.
     */
    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    /**
     * If the game is won if the item
     * is combined with right other item.
     *
     * No UI created for setting property.
     * Use sqlite to update table.
     */
    #[ORM\Column(nullable: false)]
    private bool $isLast = false;

    /**
     * If the item is hidden.
     */
    #[ORM\Column(nullable: false)]
    private bool $hidden = false;

    /**
     * The connected item that is revealed if
     * an examine reveals it
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $examineReveal = null;

    /**
     * The connected item that is revealed if a
     * combination reveals it
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $combinationReveal = null;

    /**
     * The connected item that is the right to combine
     */
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $combo = null;


    /**
     * Method to get the name of the item
     * @return string the name of the item
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Method to get the description of the item
     * @return string the description of the item
     */
    public function getExamine(): string
    {
        return $this->examine;
    }

    /**
     * Returns true if examining the item is the
     * end of the game, otherwise false
     * @return bool
     */
    public function isDeadly(): bool
    {
        return $this->deadly;
    }

    /**
     * Returns true if if the item
     * is pickable, otherwise false
     * @return bool
     */
    public function isPickable(): bool
    {
        return $this->pickable;
    }

    /**
     * Returns a string if the item is possible
     * to combine with other item, otherwise null.
     * @return string|null
     */
    public function getCombText(): ?string
    {
        return $this->combText;
    }

    /**
     * Returns the room connected to the item,
     * if there is one
     * @return Room|null
     */
    public function getRoom(): ?Room
    {
        return $this->room;
    }

    /**
     * Sets the room connected to the item
     */
    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Returns true if the game is won
     * if the item is combined with
     * the right item, otherwise false
     * @return bool
     */
    public function isLast(): bool
    {
        return $this->isLast;
    }

    /**
     * Returns true if the item is
     * hidden, otherwise false
     * @return bool
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Updates the items hidden propery
     */
    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    /**
     * Returns an item if the item is found when
     * examined.
     * @return Item|null
     */
    public function getExamineReveal(): ?Item
    {
        return $this->examineReveal;
    }

    /**
     * Returns an item if the item is found when
     * combined.
     * @return Item|null
     */
    public function getCombinationReveal(): ?Item
    {
        return $this->combinationReveal;
    }

    /**
     * Returns the item that is the right to
     * combine
     * @return Item|null
     */
    public function getCombo(): ?Item
    {
        return $this->combo;
    }
}
