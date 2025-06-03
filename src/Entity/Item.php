<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\Column(length: 25, unique: true)]
    private string $id = "";

    #[ORM\Column(length: 255, nullable: false)]
    private string $examine = "";

    #[ORM\Column(nullable: false)]
    private bool $deadly = false;

    #[ORM\Column(nullable: false)]
    private bool $pickable = false;

    #[ORM\Column(name: "comb_text", length: 255, nullable: true)]
    private ?string $combText = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    #[ORM\Column(nullable: false)]
    private bool $isLast = false;

    #[ORM\Column(nullable: false)]
    private bool $hidden = false;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $examineReveal = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $combinationReveal = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Item $combo = null;


    public function getId(): string
    {
        return $this->id;
    }

    public function getExamine(): string
    {
        return $this->examine;
    }

    public function isDeadly(): bool
    {
        return $this->deadly;
    }

    public function isPickable(): bool
    {
        return $this->pickable;
    }

    public function getCombText(): ?string
    {
        return $this->combText;
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

    public function isLast(): bool
    {
        return $this->isLast;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): static
    {
        $this->hidden = $hidden;

        return $this;
    }

    public function getExamineReveal(): ?Item
    {
        return $this->examineReveal;
    }

    public function getCombinationReveal(): ?Item
    {
        return $this->combinationReveal;
    }

    public function getCombo(): ?Item
    {
        return $this->combo;
    }
}
