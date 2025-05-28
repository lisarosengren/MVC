<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\Column(length: 25, unique: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $examine = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $examine_reveal = null;

    #[ORM\Column]
    private ?bool $deadly = null;

    #[ORM\Column]
    private ?bool $pickable = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $combination = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comb_text = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $comb_reveal = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Room $room = null;

    
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getExamineReveal(): ?string
    {
        return $this->examine_reveal;
    }

    public function setExamineReveal(?string $examine_reveal): static
    {
        $this->examine_reveal = $examine_reveal;

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

    public function getCombination(): ?string
    {
        return $this->combination;
    }

    public function setCombination(?string $combination): static
    {
        $this->combination = $combination;

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

    public function getCombReveal(): ?string
    {
        return $this->comb_reveal;
    }

    public function setCombReveal(?string $comb_reveal): static
    {
        $this->comb_reveal = $comb_reveal;

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
}
