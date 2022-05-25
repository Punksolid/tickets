<?php

namespace Tests\Feature\Jobs;

use Goutte\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpClient\HttpClient;
use Tests\TestCase;

class FetchIncidentsJobTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $get_proxies = $this->getProxies();
        // config a proxy connection
        foreach ($get_proxies as $new_proxy) {
            try {
                $client = HttpClient::create([
                    'timeout' => 2,
                    'proxy' => $new_proxy,
                    'headers' => [
                        'User-Agent' => 'curl/7.68.0',
                        'Accept' => 'Application/json',
                    ]
                ]);

                $response = $client->request('GET', 'https://apps.culiacan.gob.mx/');
                dump($response->getStatusCode());
                dump('success');
                dump($new_proxy);
            } catch (\Exception $e) {
                dump('Error '. $e->getMessage());
            }

        }



    }

    private function getProxies(): array
    {
        // file get laravel
        $file = file_get_contents(storage_path('/app/ips-data_center.txt'));
        $proxies = explode("\n", $file);
        foreach ($proxies as $proxy){
            $proxy = trim($proxy);
            if (empty($proxy)) {
                continue;
            }
            $proxy = explode(':', $proxy);
            $proxy = $proxy[2].':'.$proxy[3].'@'. $proxy[0] . ':' . $proxy[1];
            $proxies_url[] = $proxy;
        }
        return $proxies_url;

    }
}
