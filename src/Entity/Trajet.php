<?php

namespace App\Entity;

use App\Repository\TrajetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrajetRepository::class)]
class Trajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $startHour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $endHour = null;

    #[ORM\Column(length: 255)]
    private ?string $startLoc = null;

    #[ORM\Column(length: 255)]
    private ?string $endLoc = null;

    #[ORM\Column(nullable: true)]
    private ?int $days = null;

    /**
     * @var Collection<int, BusDate>
     */
    #[ORM\OneToMany(targetEntity: BusDate::class, mappedBy: 'trajet')]
    private Collection $busDates;

    public function __construct()
    {
        $this->busDates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartHour(): ?\DateTimeInterface
    {
        return $this->startHour;
    }

    public function setStartHour(\DateTimeInterface $startHour): static
    {
        $this->startHour = $startHour;

        return $this;
    }

    public function getEndHour(): ?\DateTimeInterface
    {
        return $this->endHour;
    }

    public function setEndHour(\DateTimeInterface $endHour): static
    {
        $this->endHour = $endHour;

        return $this;
    }

    public function getStartLoc(): ?string
    {
        return $this->startLoc;
    }

    public function setStartLoc(string $startLoc): static
    {
        $this->startLoc = $startLoc;

        return $this;
    }

    public function getEndLoc(): ?string
    {
        return $this->endLoc;
    }

    public function setEndLoc(string $endLoc): static
    {
        $this->endLoc = $endLoc;

        return $this;
    }

    public function getDays(): ?int
    {
        return $this->days;
    }

    public function setDays(int $days): static
    {
        $this->days = $days;

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
            $busDate->setTrajet($this);
        }

        return $this;
    }

    public function removeBusDate(BusDate $busDate): static
    {
        if ($this->busDates->removeElement($busDate)) {
            // set the owning side to null (unless already changed)
            if ($busDate->getTrajet() === $this) {
                $busDate->setTrajet(null);
            }
        }

        return $this;
    }
}
