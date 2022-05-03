<?php

namespace Tests\Feature\Jobs;

use App\Jobs\MapService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MapServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fugas_de_agua_is_4(): void
    {
        $mapper = new MapService();
        $id_service = $mapper->toId('Fugas de Agua');
        $this->assertEquals(4, $id_service);
    }

    public function test_aseo_y_limpia_is_2()
    {
        $mapper = new MapService();
        $service_name = $mapper->toName(2);
        $this->assertEquals('Aseo y Limpia', $service_name);
    }
}
