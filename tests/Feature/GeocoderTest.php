<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Geocoder\Geocoder;
use Tests\TestCase;

class GeocoderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_ayuntamiento_address()
    {
        $address = 'Avenida Gral. Alvaro Obregon S/N esq. Calle Carl. Mariano Escobedo, Centro, 80000 Culiacán Rosales, Sin.';
        $client = new Client();
        $geocoder = new Geocoder($client);
        // set token
        $geocoder->setApiKey(config('geocoder.key'));
        $geocoder->setLanguage('es');
        $geocoder->setRegion('mx');
        $geocoder->setCountry('mx');

        $result = $geocoder->getCoordinatesForAddress($address);

        dd($result);

    }
}
