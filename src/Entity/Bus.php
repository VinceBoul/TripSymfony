<?php

namespace App\Entity;

use App\Repository\BusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusRepository::class)]
class Bus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbPlaces = null;

    /**
     * @var Collection<int, BusDate>
     */
    #[ORM\OneToMany(targetEntity: BusDate::class, mappedBy: 'bus')]
    private Collection $busDates;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->busDates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * @return Collection<int, BusDate>
     */
    public function getBusDates(): Collection
    {
        return $this->busDates;
    }

    public function addBusDate(BusDate $busDate): static
    {
        if (!$this->busDates->contains($busDate)) {
            $this->busDates->add($busDate);
            $busDate->setBus($this);
        }

        return $this;
    }

    public function removeBusDate(BusDate $busDate): static
    {
        if ($this->busDates->removeElement($busDate)) {
            // set the owning side to null (unless already changed)
            if ($busDate->getBus() === $this) {
                $busDate->setBus(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
