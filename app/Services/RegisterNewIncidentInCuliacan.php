<?php

namespace App\Services;

use Goutte\Client;
use Monolog\Logger;
use Symfony\Component\DomCrawler\Crawler;

class RegisterNewIncidentInCuliacan
{
    const REGISTER_URL = 'https://apps.culiacan.gob.mx/ciudadano/ciudadano/reportes/registrar_reporte';

    public function __invoke(int    $service_id,
                             int    $service_type,
                             string $report_message,
                             int    $colonia,
                             string $street,
                             ?int   $postal_code): int
    {
        $client = new Client();
        $call = $client->request('POST', self::REGISTER_URL,  [
            'servicio' => $service_id,
            'tipo_servicio' => $service_type,
            'reporte' => $report_message,
            'calle' => $street,
            'numero' => '0',
            'id_colonia' => $colonia,
            'codigo_postal' => $postal_code ?: '',
            'nombreId' => '',
            'nombre' => 'anonimo',
            'domicilio' => '',
            'correo' => 'anonimo@test.com',
            'telefono' => '6666666666',
            'celular' => '6666666666',
            'denuncia_nombre' => '',
            'denuncia_domicilio' => '',
            'denuncia_originario' => '',
            'denuncia_nacionalidad' => '',
            'denuncia_telefono' => '',
            'denuncia_escolaridad' => '',
            'denuncia_edad' => '0',
            'denuncia_sexo' => '',
            'denuncia_ocupacion' => '',
            'denuncia_estado_civil' => '',
            'denuncia_correo' => '',
            'denuncia_rfc' => '',
            'denunciado_nombre' => '',
            'denunciado_domicilio' => '',
            'denunciado_cargo' => '',
            'denunciado_razon_social' => '',
            'denuncia_hechos' => '',
            'denuncia_medios' => 'no',
            'denuncia_publicas_url' => '',
            'denuncia_privadas_url' => '',
            'testigo_existe' => '0',
            'denuncia_informacion_url' => '',
            'denuncia_otros' => '',
            'latitud' => '24.806632',
            'longitud' => '-107.394393',
            'testigo_nombre' => '',
            'testigo_domicilio' => '',
            'testigo_telefono' => '',
        ]);
        Logger::info('Registrada nueva denuncia', [$call->html()]);

        $response = json_decode($call->html());

        return $response->mensaje;
    }
}
