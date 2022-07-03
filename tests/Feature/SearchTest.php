<?php

namespace Tests\Feature;

use App\Models\Incident;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    use WithFaker, DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_simple_search_incident()
    {
        $incident_report = Incident::factory()->create([
            'reporte' => 'False '. $this->faker->text(500),
        ]);

        $report = explode(' ', $incident_report->reporte);
        $query_search = 'reporte='.$report[4];

        $response = $this->get('/incidents/?'. $query_search);

        $response->assertStatus(200);
        $response->assertSee($report[1]);
        $response->assertSee($report[2]);

    }
}
