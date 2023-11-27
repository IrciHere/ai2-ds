<?php

namespace App\Controller;

use App\Entity\Forecast;
use App\Service\WeatherUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;

class WeatherApiController extends AbstractController
{
    public function __construct(private readonly WeatherUtil $weatherUtil)
    {
    }

    #[Route('/api/v1/weather', name: 'app_weather_api')]
    public function index(
        #[MapQueryParameter] string $city,
        #[MapQueryParameter] string $country,
        #[MapQueryParameter] string $format = 'json',
        #[MapQueryParameter] bool $twig = false,
    ): Response
    {
        $forecasts = $this->weatherUtil->getWeatherForCountryAndName($country, $city);

        if ($format === 'json') {
            if ($twig) {
                return $this->render('weather_api/index.json.twig', [
                    'city' => $city,
                    'country' => $country,
                    'forecasts' => $forecasts
                ]);
            }

            return $this->json([
                'city' => $city,
                'country' => $country,
                'forecasts' => array_map(fn(Forecast $f) => [
                    'date' => $f->getTimestamp()->format('Y-m-d'),
                    'celsius' => $f->getTemperature(),
                    'fahrenheit' => $f->getFahrenheit()
                ], $forecasts),
            ]);
        }

        if ($format === 'csv') {
            if ($twig) {
                return $this->render('weather_api/index.csv.twig', [
                    'city' => $city,
                    'country' => $country,
                    'forecasts' => $forecasts
                ]);
            }

           return $this->csvResponse($city, $country, $forecasts);
        }

        return $this->json([
            'error' => 'Format must be either "json" or "csv"'
        ]);
    }

    private function csvResponse(string $city, string $country, array $forecasts): Response
    {
        $csv = 'city,country,date,celsius,fahrenheit\n';

        foreach ($forecasts as $forecast) {
            $csv .= sprintf(
                    '%s,%s,%s,%s,%s',
                    $city,
                    $country,
                    $forecast->getTimestamp()->format('Y-m-d'),
                    $forecast->getTemperature(),
                    $forecast->getFahrenheit()
                ) . '\n';
        }

        return new Response($csv, 200, [
            'Content-Type' => 'text/csv'
        ]);
    }
}
