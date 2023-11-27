<?php

namespace App\Tests\Entity;

use App\Entity\Forecast;
use PHPUnit\Framework\TestCase;

class ForecastTest extends TestCase
{
    /**
     * @dataProvider dataGetFahrenheit
     */
    public function testGetFahrenheit($celsius, $expectedFahrenheit): void
    {
        $forecast = new Forecast();

        $forecast->setTemperature($celsius);
        $this->assertTrue($forecast->getFahrenheit() == $expectedFahrenheit);
    }

    public function dataGetFahrenheit(): array
    {
        return [
            ['0', 32],
            ['-100', -148],
            ['100', 212],
            ['0.5', 32.9],
            ['-10', 14],
            ['10', 50],
            ['23', 73.4],
            ['15', 59],
            ['-18', -0.4],
            ['36', 96.8]
        ];
    }
}
