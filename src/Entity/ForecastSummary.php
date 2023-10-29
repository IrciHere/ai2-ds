<?php

namespace App\Entity;

use App\Repository\ForecastSummaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForecastSummaryRepository::class)]
class ForecastSummary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'forecastSummary', targetEntity: Forecast::class)]
    private Collection $forecast;

    public function __construct()
    {
        $this->forecast = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Forecast>
     */
    public function getForecast(): Collection
    {
        return $this->forecast;
    }

    public function addForecast(Forecast $forecast): static
    {
        if (!$this->forecast->contains($forecast)) {
            $this->forecast->add($forecast);
            $forecast->setForecastSummary($this);
        }

        return $this;
    }

    public function removeForecast(Forecast $forecast): static
    {
        if ($this->forecast->removeElement($forecast)) {
            // set the owning side to null (unless already changed)
            if ($forecast->getForecastSummary() === $this) {
                $forecast->setForecastSummary(null);
            }
        }

        return $this;
    }
}
