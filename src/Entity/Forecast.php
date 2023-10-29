<?php

namespace App\Entity;

use App\Repository\ForecastRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForecastRepository::class)]
class Forecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'forecasts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: '0')]
    private ?string $temperature = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: '0')]
    private ?string $windSpeed = null;

    #[ORM\Column]
    private ?int $precipitation = null;

    #[ORM\ManyToOne(inversedBy: 'forecast')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ForecastSummary $forecastSummary = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getWindSpeed(): ?string
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(string $windSpeed): static
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getPrecipitation(): ?int
    {
        return $this->precipitation;
    }

    public function setPrecipitation(int $precipitation): static
    {
        $this->precipitation = $precipitation;

        return $this;
    }

    public function getForecastSummary(): ?ForecastSummary
    {
        return $this->forecastSummary;
    }

    public function setForecastSummary(?ForecastSummary $forecastSummary): static
    {
        $this->forecastSummary = $forecastSummary;

        return $this;
    }
}
