<?php

namespace App\Services;

//use Goutte\Client;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Monolog\Logger;
use Symfony\Component\DomCrawler\Crawler;


class RegisterNewIncidentInCuliacan
{
    const REGISTER_URL = 'https://apps.culiacan.gob.mx/ciudadano/ciudadano/reportes/registrar_reporte';
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function __invoke(string  $service_id,
                             string  $service_type,
                             string  $report_message,
                             string  $colonia,
                             string  $street,
                             ?string $postal_code): int
    {
//        $client = new Client();
//        \logger()->info('Attempting to register new incident in Culiacan', [
//            'service_id' => $service_id,
//            'service_type' => $service_type,
//            'report_message' => $report_message,
//            'colonia' => $colonia,
//            'street' => $street,
//            'postal_code' => $postal_code,
//        ]);
//
//        $call = $client->request('POST', self::REGISTER_URL,  [
//            'servicio' => (string)$service_id,
//            'tipo_servicio' => (string)$service_type,
//            'reporte' => $report_message,
//            'calle' => $street,
//            'numero' => '0',
//            'id_colonia' => (string) $colonia,
//            'codigo_postal' => $postal_code ?: '',
//            'nombreId' => '',
//            'nombre' => 'anonimo',
//            'domicilio' => '',
//            'correo' => 'test@test.com',
//            'telefono' => '6666666666',
//            'celular' => '6666666666',
//            'denuncia_nombre' => '',
//            'denuncia_domicilio' => '',
//            'denuncia_originario' => '',
//            'denuncia_nacionalidad' => '',
//            'denuncia_telefono' => '',
//            'denuncia_escolaridad' => '',
//            'denuncia_edad' => '0',
//            'denuncia_sexo' => '',
//            'denuncia_ocupacion' => '',
//            'denuncia_estado_civil' => '',
//            'denuncia_correo' => '',
//            'denuncia_rfc' => '',
//            'denunciado_nombre' => '',
//            'denunciado_domicilio' => '',
//            'denunciado_cargo' => '',
//            'denunciado_razon_social' => '',
//            'denuncia_hechos' => '',
//            'denuncia_medios' => 'no',
//            'denuncia_publicas_url' => '',
//            'denuncia_privadas_url' => '',
//            'testigo_existe' => '0',
//            'denuncia_informacion_url' => '',
//            'denuncia_otros' => '',
//            'latitud' => '24.806632',
//            'longitud' => '-107.394393',
//            'testigo_nombre' => '',
//            'testigo_domicilio' => '',
//            'testigo_telefono' => '',
//        ], [
//            'Accept' => '*/*',
//            'X-Requested-With' => 'XMLHttpRequest',
//            'Accept-Encoding' => 'gzip, deflate, br',
//            'Accept-Language' => 'en-US,en;q=0.5',
//            'Connection' => 'keep-alive',
//            'Origin' => 'https://apps.culiacan.gob.mx',
//            'Referer' => 'https://apps.culiacan.gob.mx/ciudadano/reportar',
//            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0',
//            'Sec-Fetch-Site' => 'same-origin',
//            'Sec-Fetch-Mode' => 'cors',
//            'Sec-Fetch-Dest' => 'empty',
//            'Cookie' => 'ventanillaactiva=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22fb8612789c72d17072d57c1eb6a1a6b0%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22187.145.104.196%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A70%3A%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%3B+rv%3A103.0%29+Gecko%2F20100101+Firefox%2F103.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1659067237%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7Df4526f4d061767aabe57960f1e16a918; _ga=GA1.3.505146067.1659060468; _gid=GA1.3.1622479335.1659060468; ventanillaactiva=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%227b9d288f418252f2a37eb8478649dd25%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22187.145.104.196%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A70%3A%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%3B+rv%3A103.0%29+Gecko%2F20100101+Firefox%2F103.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1659395175%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D4406e299f938cd5092f55367c427cffe',
//            'TE' => 'trailers',
//        ]);

        $response = $this->request($service_id,
            $service_type,
            $report_message,
            $colonia,
            $street,
            $postal_code);


        $response = json_decode($response, true);

        \logger()->info('Registrada nueva denuncia', [$response]);

        return $response['mensaje'];
    }

    public function request(string  $service_id,
                            string  $service_type,
                            string  $report_message,
                            string  $colonia,
                            string  $street,
                            ?string $postal_code): string
    {

        $client = new Client();
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0',
            'Accept' => '*/*',
            'Accept-Language' => 'en-US,en;q=0.5',
            'Accept-Encoding' => 'gzip, deflate, br',
            'X-Requested-With' => 'XMLHttpRequest',
            'Origin' => 'https://apps.culiacan.gob.mx',
            'Connection' => 'keep-alive',
            'Referer' => 'https://apps.culiacan.gob.mx/ciudadano/reportar',
            'Cookie' => 'ventanillaactiva=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22fb8612789c72d17072d57c1eb6a1a6b0%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22187.145.104.196%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A70%3A%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%3B+rv%3A103.0%29+Gecko%2F20100101+Firefox%2F103.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1659067237%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7Df4526f4d061767aabe57960f1e16a918; _ga=GA1.3.505146067.1659060468; _gid=GA1.3.1622479335.1659060468; ventanillaactiva=a%3A5%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%227b9d288f418252f2a37eb8478649dd25%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22187.145.104.196%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A70%3A%22Mozilla%2F5.0+%28X11%3B+Linux+x86_64%3B+rv%3A103.0%29+Gecko%2F20100101+Firefox%2F103.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1659395175%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3B%7D4406e299f938cd5092f55367c427cffe',
            'Sec-Fetch-Dest' => 'empty',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Site' => 'same-origin',
            'TE' => 'trailers'
        ];
        $options = [
            'multipart' => [
                [
                    'name' => 'servicio',
                    'contents' => $service_id,
                ],
                [
                    'name' => 'tipo_servicio',
                    'contents' => $service_type
                ],
                [
                    'name' => 'reporte',
                    'contents' => $report_message
                ],
                [
                    'name' => 'calle',
                    'contents' => $street
                ],
                [
                    'name' => 'numero',
                    'contents' => '0'
                ],
                [
                    'name' => 'id_colonia',
                    'contents' => (string)$colonia
                ],
                [
                    'name' => 'codigo_postal',
                    'contents' => $postal_code ?? '0'
                ],
                [
                    'name' => 'nombreId',
                    'contents' => ''
                ],
                [
                    'name' => 'nombre',
                    'contents' => 'anonimo'
                ],
                [
                    'name' => 'domicilio',
                    'contents' => ''
                ],
                [
                    'name' => 'correo',
                    'contents' => 'test@test.com'
                ],
                [
                    'name' => 'telefono',
                    'contents' => '6666666666'
                ],
                [
                    'name' => 'celular',
                    'contents' => '6666666666'
                ],
                [
                    'name' => 'nombreId',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_nombre',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_domicilio',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_originario',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_nacionalidad',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_telefono',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_escolaridad',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_edad',
                    'contents' => '0'
                ],
                [
                    'name' => 'denuncia_sexo',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_ocupacion',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_estado_civil',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_correo',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_rfc',
                    'contents' => ''
                ],
                [
                    'name' => 'denunciado_nombre',
                    'contents' => ''
                ],
                [
                    'name' => 'denunciado_domicilio',
                    'contents' => ''
                ],
                [
                    'name' => 'denunciado_cargo',
                    'contents' => ''
                ],
                [
                    'name' => 'denunciado_razon_social',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_hechos',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_medios',
                    'contents' => 'no'
                ],
                [
                    'name' => 'denuncia_publicas_url',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_privadas_url',
                    'contents' => ''
                ],
                [
                    'name' => 'testigo_existe',
                    'contents' => '0'
                ],
                [
                    'name' => 'denuncia_informacion_url',
                    'contents' => ''
                ],
                [
                    'name' => 'denuncia_otros',
                    'contents' => ''
                ],
                [
                    'name' => 'latitud',
                    'contents' => '24.806632'
                ],
                [
                    'name' => 'longitud',
                    'contents' => '-107.394393'
                ],
                [
                    'name' => 'testigo_nombre',
                    'contents' => ''
                ],
                [
                    'name' => 'testigo_domicilio',
                    'contents' => ''
                ],
                [
                    'name' => 'testigo_telefono',
                    'contents' => ''
                ]
            ]];
        $request = new Request('POST', 'https://apps.culiacan.gob.mx/ciudadano/ciudadano/reportes/registrar_reporte', $headers);
        $response = $client->sendAsync($request, $options)->wait();
        return $response->getBody();

    }
}
