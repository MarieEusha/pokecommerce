<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'string')]
    private Uuid $uuid;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $releaseDate;

    #[ORM\Column(type: 'integer')]
    private int $number;

    #[ORM\ManyToOne(targetEntity: Rarity::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private Rarity $rarity;

    #[ORM\ManyToOne(targetEntity: Shiny::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private Shiny $shiny;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'cards')]
    #[ORM\JoinColumn(nullable: false)]
    private Serie $serie;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
    }

    /**
     * @return string|null
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    /**
     * @param \DateTimeInterface $releaseDate
     * @return $this
     */
    public function setReleaseDate(\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return Rarity|null
     */
    public function getRarity(): ?Rarity
    {
        return $this->rarity;
    }

    /**
     * @param Rarity|null $rarity
     * @return $this
     */
    public function setRarity(?Rarity $rarity): self
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * @return Shiny|null
     */
    public function getShiny(): ?Shiny
    {
        return $this->shiny;
    }

    /**
     * @param Shiny|null $shiny
     * @return $this
     */
    public function setShiny(?Shiny $shiny): self
    {
        $this->shiny = $shiny;

        return $this;
    }

    /**
     * @return Serie|null
     */
    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    /**
     * @param Serie|null $serie
     * @return $this
     */
    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }
}
