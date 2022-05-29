<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $releaseDate;

    #[ORM\ManyToOne(targetEntity: Rarity::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private $rarity;

    #[ORM\ManyToOne(targetEntity: Shiny::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private $shiny;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private $serie;

    #[ORM\Column(type: 'integer')]
    private $number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getRarity(): ?Rarity
    {
        return $this->rarity;
    }

    public function setRarity(?Rarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    public function getShiny(): ?Shiny
    {
        return $this->shiny;
    }

    public function setShiny(?Shiny $shiny): self
    {
        $this->shiny = $shiny;

        return $this;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
