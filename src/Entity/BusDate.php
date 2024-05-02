<?php

namespace App\Entity;

use App\Repository\BusDateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusDateRepository::class)]
class BusDate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $placeRestantes = null;

    #[ORM\ManyToOne(inversedBy: 'busDates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trajet $trajet = null;

    #[ORM\ManyToOne(inversedBy: 'busDates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bus $bus = null;

    /**
     * @var Collection<int, DateEx>
     */
    #[ORM\OneToMany(targetEntity: DateEx::class, mappedBy: 'busDate', cascade: ["persist", "remove"])]
    private Collection $datesEx;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'reservations')]
    private Collection $users;

    public function __construct()
    {
        $this->datesEx = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaceRestantes(): ?int
    {
        return $this->placeRestantes;
    }

    public function setPlaceRestantes(int $placeRestantes): static
    {
        $this->placeRestantes = $placeRestantes;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): static
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getBus(): ?Bus
    {
        return $this->bus;
    }

    public function setBus(?Bus $bus): static
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * @return Collection<int, DateEx>
     */
    public function getDatesEx(): Collection
    {
        return $this->datesEx;
    }

    public function addDatesEx(DateEx $datesEx): static
    {
        if (!$this->datesEx->contains($datesEx)) {
            $this->datesEx->add($datesEx);
            $datesEx->setBusDate($this);
        }

        return $this;
    }

    public function removeDatesEx(DateEx $datesEx): static
    {
        if ($this->datesEx->removeElement($datesEx)) {
            // set the owning side to null (unless already changed)
            if ($datesEx->getBusDate() === $this) {
                $datesEx->setBusDate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addReservation($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeReservation($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTrajet()->getStartLoc() . ' ' .$this->getTrajet()->getEndLoc() . ' - Bus : '. $this->getBus()->getName();
    }

}
