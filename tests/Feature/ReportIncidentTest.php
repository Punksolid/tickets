<?php

namespace Tests\Feature;

use App\Models\Incident;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportIncidentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_report_incident()
    {
        /*
         *       'folio',
        'dependencia',
        'id_asignacion',
        'reporte',
        'ciudadano',
        'domicilio',
        'servicio',
        'fecha',
        'usuario',
        'asignacion',
        'status',
         */
        // Call factory of Incident model
        $incident = Incident::factory()->make();
        $response = $this->post('/incidents', [
            'dependencia' => 'Test Incident',
            'description' => 'Test Description',
            'location' => 'Test Location',
            'latitude' => '-6.2',
            'longitude' => '106.8',
            'type' => 'Test Type',
            'status' => 'Test Status',
            'images' => 'Test Images',
            'videos' => 'Test Videos',
            'sounds' => 'Test Sounds',
            'user_id' => '1',
            'created_at' => '2020-01-01 00:00:00',
            'updated_at' => '2020-01-01 00:00:00',
        ]);

        $response->assertStatus(200);

        $this->assertEquals('Aseo y Limpia', $response->json('category'));
    }
}
