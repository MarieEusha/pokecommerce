<?php

namespace App\Entity\User;

use App\Entity\Address;
use App\Entity\Offer;
use App\Entity\Order;
use App\Repository\FrontUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrontUserRepository::class)]
class FrontUser extends BaseUser
{
    #[ORM\OneToMany(mappedBy: 'seller', targetEntity: Offer::class)]
    private ArrayCollection $offers;

    #[ORM\OneToMany(mappedBy: 'buyer', targetEntity: Order::class)]
    private ArrayCollection $orders;

    #[ORM\OneToMany(targetEntity: Address::class)]
    private ArrayCollection $shippingAddresses;

    #[ORM\OneToMany(targetEntity: Address::class)]
    private ArrayCollection $billingAddresses;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->shippingAddresses = new ArrayCollection();
        $this->billingAddresses = new ArrayCollection();
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers[] = $offer;
            $offer->setSeller($this);
        }

        return $this;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getSeller() === $this) {
                $offer->setSeller(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setBuyer($this);
        }

        return $this;
    }

    /**
     * @param Order $order
     * @return $this
     */
    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getBuyer() === $this) {
                $order->setBuyer(null);
            }
        }

        return $this;
    }

    public function getShippingAddresses(): Collection
    {
        return $this->shippingAddresses;
    }

    /**
     * @param Address $shippingAddress
     * @return $this
     */
    public function addShippingAddress(Address $shippingAddress): self
    {
        if (!$this->shippingAddresses->contains($shippingAddress)) {
            $this->shippingAddresses[] = $shippingAddress;
        }

        return $this;
    }

    /**
     * @param Address $shippingAddress
     * @return $this
     */
    public function removeShippingAdress(Address $shippingAddress): self
    {
        $this->shippingAddresses->removeElement($shippingAddress);

        return $this;
    }

    public function getBillingAddresses(): Collection
    {
        return $this->billingAddresses;
    }

    /**
     * @param Address $billingAddress
     * @return $this
     */
    public function addBillingAddress(Address $billingAddress): self
    {
        if (!$this->billingAddresses->contains($billingAddress)) {
            $this->billingAddresses[] = $billingAddress;
        }

        return $this;
    }

    /**
     * @param Address $billingAddress
     * @return $this
     */
    public function removeBillingAdress(Address $billingAddress): self
    {
        $this->billingAddresses->removeElement($billingAddress);

        return $this;
    }
}
