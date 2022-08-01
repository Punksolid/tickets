<?php

namespace App\Jobs;

use App\Models\Multa;
use Goutte\Client;
use Illuminate\Foundation\Bus\Dispatchable;
use PhpParser\Node\Expr\AssignOp\Mul;
use Symfony\Component\DomCrawler\Crawler;

class FetchAndScrapMulta
{
    use Dispatchable;

    private $folio;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($folio)
    {

        $this->folio = $folio;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        if (Multa::where('folio', 'J'.$this->folio)->exists()) {
            return;
        }
        // make request
        $crawler = $this->request($this->folio);
        $data = $this->scrap($crawler);

        // save data

        $multa = new Multa();
        $multa->folio = $data['folio'];
        $multa->placa = $data['placa'];
        $multa->importe =  $data['importe'];
        $multa->redondeo = $data['redondeo'];
        $multa->conceptos = $data['conceptos'];
        $multa->full_html = $crawler->html();
        $multa->save();

    }

    public function request($folio_multa): Crawler
    {
        $client = new Client();
        return $client->request('GET', 'https://pagos.culiacan.gob.mx/multas-transito/J'. $folio_multa);
    }

    public function scrap(Crawler $crawler): array
    {
        $importe = $crawler->filter('body > div.datos-boleta > div > dl > dd')->eq(2)->html();
        $importe = trim(str_replace('$', '', $importe));
        $conceptos = $crawler->filter('tbody > .detalle-boleta > tr')->each(function ($node) {
            return [
                'concepto_id' => $node->filter('td')->eq(0)->html(),
                'descripcion' => $node->filter('td')->eq(1)->html(),
                'importe' => $node->filter('td')->eq(2)->html(),
            ];
        });

        return [
            'folio' => $crawler->filter('body > div.datos-boleta > div > dl > dd')->eq(0)->html(),
            'placa' => $crawler->filter('body > div.datos-boleta > div > dl > dd')->eq(1)->html(),
            'importe' => $importe,
            'redondeo' => $crawler->filter('body > div.datos-boleta > div > dl > dd')->eq(3)->html(),
            'conceptos' => $conceptos
        ];
    }
}
