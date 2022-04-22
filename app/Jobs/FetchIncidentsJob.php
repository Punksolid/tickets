<?php

namespace App\Jobs;

use App\Models\Incident;
use Exception;
use Goutte\Client;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class FetchIncidentsJob
{
    use Dispatchable;

    private $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($page)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $incidents = $this->requestAndScrap();

        try {
            Incident::insert($incidents);
        } catch (Exception $exception) {
            dump($incidents);
            dump('ERROR HERE' . $exception->getMessage());
            logger($exception->getMessage(), [$exception->getTrace(), 'set' => $incidents]);
        }


    }

    /**
     * @return array
     */
    public function requestAndScrap(): array
    {

        $crawler = $this->request();

        $incidents = $crawler->filter('tbody > tr')->each(function ($node) {
            $asignacion_field = $node->filter('td')->eq(3);

            return [
                'folio' => $node->filter('td')->eq(10)->filter('a')->attr('data-id-reporte'),
                'dependencia' => $node->filter('td')->eq(1)->text(),
                'id_asignacion' => $node->filter('td')->eq(2)->text(),
                'prioridad' => $node->filter('td')->eq(4)->filter('span')->text(),
                'reporte' => $node->filter('td')->eq(4)->filter('small')->text(),
                'ciudadano' => $node->filter('td')->eq(5)->text(),
                'domicilio' => $node->filter('td')->eq(6)->text(),
                'servicio' => $node->filter('td')->eq(7)->text(),
                'fecha' => $node->filter('td')->eq(8)->text(),
                'usuario' => $node->filter('td')->eq(9)->text(),
                'asignacion' => $asignacion_field->filter('small')->text(),
                'status' => $asignacion_field->filter('span')->text(),
            ];
        });

        return $incidents;
    }

    /**
     * @return Crawler|null
     */
    public function request(): ?Crawler
    {
        $goutte_client = new Client(HttpClient::create(['headers' => ['X-Requested-With' => 'XMLHttpRequest']]));
        $elements = $this->page * 20;
        return $goutte_client->request('POST', "https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/$elements", [
            'X-Requested-With' => 'XMLHttpRequest'
        ]);
    }
}
