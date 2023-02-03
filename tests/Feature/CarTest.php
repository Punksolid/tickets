<?php

namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // convert the following request to a GET request using Goutte
//        await fetch("https://api.sinaloa.gob.mx/api/tramites/canjeplacas/formatoPago?placa=VHM122B", {
//        "credentials": "include",
//        "headers": {
//            "User-Agent": "Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0",
//            "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8",
//            "Accept-Language": "es-MX,es;q=0.8,en-US;q=0.5,en;q=0.3",
//            "Upgrade-Insecure-Requests": "1",
//            "Sec-Fetch-Dest": "document",
//            "Sec-Fetch-Mode": "navigate",
//            "Sec-Fetch-Site": "none",
//            "Sec-Fetch-User": "?1"
//        },
//        "method": "GET",
//        "mode": "cors"
//      });
        // request in proxy mode


        $client = new Client([
            'cookies' => true,
            'proxy' => 'tcp://localhost:8888',
        ]);
        $headers = [
            'User-Agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:103.0) Gecko/20100101 Firefox/103.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language' => 'es-MX,es;q=0.8,en-US;q=0.5,en;q=0.3',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
//            'Cookie' => 'cf_clearance=Xscg_64KQZh9Ws19geDp7QO7lh2drtKzaOrP_59ha1A-1660463593-0-250; _ga=GA1.3.1853961205.1660284514; _gid=GA1.3.1391233383.1660463596; __cf_bm=WDkJOsFblqPm3Un8arZvaJnE53YiSCbzWrKBoCfA9ic-1660469983-0-AVmeSabuN16QsKvtIuKaARLJQGUD9CcMaj/ENlfzFSd+AE41VS9UVW9WYjDqHsMEbF5dn43DOLELpUhT7hkfHQU=',
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'none',
            'Sec-Fetch-User' => '?1'
        ];
        $request = new Request('GET', 'https://api.sinaloa.gob.mx/api/tramites/canjeplacas/formatoPago?placa=VHM122B', $headers);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();


    }
}
