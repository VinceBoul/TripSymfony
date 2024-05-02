<?php

namespace App\Entity;

use App\Repository\DateExRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DateExRepository::class)]
class DateEx
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'datesEx')]
    private ?BusDate $busDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getBusDate(): ?BusDate
    {
        return $this->busDate;
    }

    public function setBusDate(?BusDate $busDate): static
    {
        $this->busDate = $busDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->date->format('d-m-Y');
    }
}
