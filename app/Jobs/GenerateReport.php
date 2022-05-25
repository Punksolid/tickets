<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $call = $this->client->post('https://apps.culiacan.gob.mx/070/ciudadano/reportes/registrar_reporte', [
            'form_params' => [
                'servicio' => $this->getIdServicio($servicio),
                'tipo_servicio' => 36,
                'reporte' => $reporte,
                'calle' => $calle,
                'numero' => $numero,
                'id_colonia' => $id_colonia,
                'codigo_postal' => $codigo_postal,
                'nombre' => 'anonimo',
                'domicilio' => '',
                'correo' => '',
                'telefono' => '',
                'celular' => '',
                'latitud' => 24.806632,
                'longitud' => -107.394393,
            ],
        ]);

        $content = $call->getBody()->getContents();
        // response {"id_denuncia":0,"mensaje":117832,"exito":true,"problema":false}

        return json_decode($content);
    }

    private function getIdServicio($servicio)
    {

    }
}

