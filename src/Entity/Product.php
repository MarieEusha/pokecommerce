<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap([
    "card" => Card::class
])]
#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    private Uuid $uuid;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function __construct()
    {
        $this->uuid = Uuid::v4();
    }

    /**
     * @return Uuid|null
     */
    public function getUuid(): ?Uuid
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
}
