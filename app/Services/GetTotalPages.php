<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class GetTotalPages
{

    public function __invoke():int
    {
        return 1 + $this->getTotalElements()/20;
    }

    public function getTotalElements(): int
    {

        $goutte_client = new Client(HttpClient::create(['headers' => ['X-Requested-With' => 'XMLHttpRequest']]));
        $goutte_response_crawler = $goutte_client->request('GET', 'https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/listado');
        $last_page_url = $goutte_response_crawler->filter('#paginacion > .pagination')->filter('li')->last()->filter('.btn-paginar')->attr('href');
        $decomposed_url = parse_url($last_page_url);
        $number_of_incidents = explode('/', $decomposed_url['path']);

        return last($number_of_incidents);
    }
}
