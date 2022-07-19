<?php

namespace App\Services;

use Goutte\Client;
use Psr\Http\Client\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class GetTotalPages
{

    public function __invoke():int
    {
        return 1 + $this->getTotalElements()/20;
    }

    public function getTotalElements(): int
    {
        $goutte_client =  $this->getClient();
        $goutte_response_crawler = $this->makeRequest($goutte_client, 'GET');
        $last_page_url = $goutte_response_crawler->filter('#paginacion > .pagination')->filter('li')->last()->filter('.btn-paginar')->attr('href');
        $decomposed_url = parse_url($last_page_url);
        $number_of_incidents = explode('/', $decomposed_url['path']);

        return last($number_of_incidents);
    }

    protected function makeRequest(Client $client, $method): Crawler
    {
        return $client->request($method, 'https://apps.culiacan.gob.mx/ciudadano/atencion-ciudadana/listado');
    }

    protected function getClient(): Client
    {
        return new Client(HttpClient::create(['headers' => ['X-Requested-With' => 'XMLHttpRequest']]));
    }
}
