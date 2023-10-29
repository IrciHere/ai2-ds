<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\ForecastRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    #[Route('/weather/{name}/{country?}', name: 'app_weather')]
    public function city(
        #[MapEntity(stripNull: true)]
        Location $location,
        ForecastRepository $repository): Response
    {
        $forecasts = $repository->findByLocation($location);

        return $this->render('weather/location.html.twig', [
            'location' => $location,
            'forecasts' => $forecasts
        ]);
    }
}
