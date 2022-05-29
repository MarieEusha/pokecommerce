<?php

namespace App\Entity;

use App\Entity\User\BaseUser;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    private Uuid $uuid;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $date;

    #[ORM\Column(type: 'float')]
    private float $totalAmount;

    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(name: 'address', referencedColumnName: 'uuid',  nullable: false)]
    private Address $billingAddress;

    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(name: 'address', referencedColumnName: 'uuid',  nullable: false)]
    private Address $shipingAddress;

    #[ORM\ManyToOne(targetEntity: BaseUser::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'buyer', referencedColumnName: 'uuid',  nullable: false)]
    private BaseUser $buyer;

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
     * @return \DateTimeInterface|null
     */
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     * @return $this
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getBillingAddress(): ?Address
    {
        return $this->billingAddress;
    }

    /**
     * @param Address|null $billingAddress
     * @return $this
     */
    public function setBillingAddress(?Address $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * @return Address|null
     */
    public function getShipingAddress(): ?Address
    {
        return $this->shipingAddress;
    }

    /**
     * @param Address|null $shipingAddress
     * @return $this
     */
    public function setShipingAddress(?Address $shipingAddress): self
    {
        $this->shipingAddress = $shipingAddress;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotalAmount(): ?float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     * @return $this
     */
    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return BaseUser|null
     */
    public function getBuyer(): ?BaseUser
    {
        return $this->buyer;
    }

    /**
     * @param BaseUser|null $buyer
     * @return $this
     */
    public function setBuyer(?BaseUser $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }
}
