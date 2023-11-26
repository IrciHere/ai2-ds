<?php

namespace App\Service;

use App\Entity\Forecast;
use App\Entity\Location;
use App\Repository\ForecastRepository;
use App\Repository\LocationRepository;

class WeatherUtil
{
    function __construct(private readonly ForecastRepository $forecastRepository,
                         private readonly LocationRepository $locationRepository) {
    }

    /**
     * @return Forecast[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        $forecasts = $this->forecastRepository->findByLocation($location);

        return $forecasts;
    }

    /**
     * @return Forecast[]
     */
    public function getWeatherForCountryAndName(string $countryCode, string $name): array
    {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryCode,
            'name' => $name
        ]);

        $forecasts = $this->forecastRepository->findByLocation($location);

        return $forecasts;
    }
}