<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\Column(length: 25, unique: true)]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $examine = null;

    #[ORM\Column]
    private ?bool $deadly = null;

    #[ORM\Column]
    private ?bool $pickable = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comb_text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $combination = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\Column]
    private ?bool $isLast = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hidden = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?item $examineReveal = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?item $combinationReveal = null;

   
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getExamine(): ?string
    {
        return $this->examine;
    }

    public function setExamine(string $examine): static
    {
        $this->examine = $examine;

        return $this;
    }

    public function isDeadly(): ?bool
    {
        return $this->deadly;
    }

    public function setDeadly(bool $deadly): static
    {
        $this->deadly = $deadly;

        return $this;
    }

    public function isPickable(): ?bool
    {
        return $this->pickable;
    }

    public function setPickable(bool $pickable): static
    {
        $this->pickable = $pickable;

        return $this;
    }

    public function getCombText(): ?string
    {
        return $this->comb_text;
    }

    public function setCombText(?string $comb_text): static
    {
        $this->comb_text = $comb_text;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): static
    {
        $this->room = $room;

        return $this;
    }

    public function isLast(): ?bool
    {
        return $this->isLast;
    }

    public function setIsLast(bool $isLast): static
    {
        $this->isLast = $isLast;

        return $this;
    }

    public function isHidden(): ?bool
    {
        return $this->hidden;
    }

    public function setHidden(?bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getItem(): ?self
    {
        return $this->item;
    }

    public function setItem(?self $item): static
    {
        $this->item = $item;

        return $this;
    }

    public function getExamineReveal(): ?item
    {
        return $this->examineReveal;
    }

    public function setExamineReveal(?item $examineReveal): static
    {
        $this->examineReveal = $examineReveal;

        return $this;
    }

    public function getCombination(): ?string
    {
        return $this->combination;
    }

    public function setCombination(?string $combination): self
    {
        $this->combination = $combination;
        
        return $this;
    }

    public function getCombinationReveal(): ?item
    {
        return $this->combinationReveal;
    }

    public function setCombinationReveal(?item $combinationReveal): static
    {
        $this->combinationReveal = $combinationReveal;

        return $this;
    }

}
