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

    /**
     * Create a new job instance.
     *
     * @param bool $is_only_sync
     *@return void
     */
    public function __construct(private $page, private readonly bool $is_only_sync = true)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $incidents = $this->requestAndScrap();
        if ($this->is_only_sync) {
            foreach ($incidents as $incident_array) {
                // throw_if(Incident::where('folio', $incident_array['folio'])->exists(), new Exception('Incident already exists'));
                if ($this->doesFolioExists($incident_array['folio'])) {
                    dump($incident_array['folio'] . ' already exists');
                    continue;
                }
                $incident  = Incident::create($incident_array);
                $incident->reported_at = $incident->fecha;
                $incident->save();
            }
        } else {
            try {
                Incident::insert($incidents);
            } catch (Exception $exception) {
                dump($incidents);
                dump('ERROR HERE' . $exception->getMessage());
                logger($exception->getMessage(), [$exception->getTrace(), 'set' => $incidents]);
            }
        }
    }

    public function createDirectoryIfNotExistFromFullPath($full_path)
    {
        if (!file_exists($full_path)) {
            mkdir($full_path, 0777, true);
        }
        
    }


    public function requestAndScrap(): array
    {

        $crawler = $this->request();

        return $crawler->filter('tbody > tr')->each(function ($node) {
            $asignacion_field = $node->filter('td')->eq(3);
            return [
                'folio' => $node->filter('td')->eq(10)->filter('a')->attr('data-id-reporte'),
                'dependencia' => $node->filter('td')->eq(1)->text(),
                'id_asignacion' => $node->filter('td')->eq(2)->text(),
                'priority' => $node->filter('td')->eq(4)->filter('span')->text(),
                'reporte' => $node->filter('td')->eq(4)->filter('small')->text(),
                'ciudadano' => $node->filter('td')->eq(5)->text(),
                'domicilio' => $node->filter('td')->eq(6)->text(),
                'servicio' => $node->filter('td')->eq(7)->filter('small')->text(),
                'fecha' => $node->filter('td')->eq(8)->text(),
                'usuario' => $node->filter('td')->eq(9)->text(),
                'asignacion' => $asignacion_field->filter('small')->text(),
                'status' => $asignacion_field->filter('span')->text(),
            ];
        });
    }

    public function request(): ?Crawler
    {
        $goutte_client = new Client(HttpClient::create(['headers' => ['X-Requested-With' => 'XMLHttpRequest']]));
        $end_elements_of_page = $this->page * 20;
        $url = config('services.the_url').'/atencion-ciudadana/reportes/paginacion/'.$end_elements_of_page;

        return $goutte_client->request('POST', $url, [
            'X-Requested-With' => 'XMLHttpRequest'
        ]);
    }

    /**
     * @param $folio
     * @return bool
     */
    public function doesFolioExists($folio): bool
    {
        return Incident::where('folio', $folio)->exists();
    }
}
