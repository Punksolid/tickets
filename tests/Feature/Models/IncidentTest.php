<?php

namespace Tests\Feature\Models;

use App\Models\Incident;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class IncidentTest extends TestCase
{

    use DatabaseTransactions;
//    use DatabaseMigrations;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_can_show_an_incident_detail(): void
    {
        $incident_details_to_show_privately = Incident::factory()->create();

        $call = $this->get(route('incidents.show', ['incident' => $incident_details_to_show_privately->id]));

        $call->assertStatus(200);
        $call->assertSee('Folio');
        $call->assertSee($incident_details_to_show_privately->folio);
        $call->assertSee('Nombre del Servicio (Departamento/Dependencia)');
        $call->assertSee($incident_details_to_show_privately->dependencia);
        $call->assertSee('Reporte');
        $call->assertSee('Nombre del Ciudadano');
        $call->assertSee('Tipo de Servicio');
        $call->assertSee('Domicilio');
        $call->assertSee('Correo Electrónico');
        $call->assertSee('Estatus');
        $call->assertSee('Mapa');
        $call->assertSee('Información adicional');
    }



    public function test_it_should_not_show_phone_number_of_citizen_if_there_is_a_phone_number_in_reporte()
    {
        $phone_number = "667{$this->faker->randomNumber(7)}";
        $incident_details_to_show_privately = Incident::factory()->create([
            'reporte' => "{$this->faker->text} {$phone_number}"
        ]);

        $call = $this->get(route('incidents.show', ['incident' => $incident_details_to_show_privately->id]));

        $call->assertStatus(200);
        $call->assertDontSee($phone_number);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_query_open_incidents_by_dependency(): void
    {
        $existing_incident_with_dependencia_alumbrado_publico = Incident::where('dependencia', 'Alumbrado Público')->count();
        $existing_incident_with_dependencia_banquetas = Incident::where('dependencia', 'Banquetas')->count();

        Incident::factory()->count(5)->create([
            'dependencia' => 'Alumbrado Público',
            'status' => 'PENDIENTE'
        ]);
        Incident::factory()->count(1)->create([
            'dependencia' => 'Alumbrado Público',
            'status' => 'Pendiente'
        ]);
        Incident::factory()->count(5)->create([
            'dependencia' => 'Alumbrado Público',
            'status' => 'ATENDIDO'
        ]);

        Incident::factory()->count(11)->create([
            'dependencia' => 'Banquetas',
            'status' => 'PENDIENTE'
        ]);


        $open_incidents_by_dependency = Incident::
            groupBy('dependencia')
        ->select(DB::raw('count(*) as total, status, dependencia'))
            ->where('status', '=', 'Pendiente')
            ->orWhere('status', '=', 'PENDIENTE')
            ->get();
        // Put dependencia index as key and total as value
        $open_incidents_by_dependency = $open_incidents_by_dependency->groupBy('dependencia');

        $open_incidents_by_dependency = $open_incidents_by_dependency->map(function ($item, $key) {
            return [
                'total' => $item->sum('total'),
                'status' => $item->first()->status,
                'dependencia' => $item->first()->dependencia
            ];
        });
        $this->assertEquals($existing_incident_with_dependencia_alumbrado_publico + 6, $open_incidents_by_dependency['Alumbrado Público']['total']);
        $this->assertEquals($existing_incident_with_dependencia_banquetas + 11, $open_incidents_by_dependency['Banquetas']['total']);
    }

    public function test_total_incident_by_status()
    {
        $existing_incident_with_status_pendiente = Incident::where('status', 'PENDIENTE')->count();
        $existing_incident_with_status_atendido = Incident::where('status', 'ATENDIDO')->count();

        Incident::factory()->count(5)->create([
            'status' => 'PENDIENTE'
        ]);
        Incident::factory()->count(15)->create([
            'status' => 'ATENDIDO'
        ]);

        $total_incident_by_status = Incident::
            groupBy('status')
        ->select(DB::raw('count(*) as total, status'))
            ->get();
        // Put dependencia index as key and total as value
        $total_incident_by_status = $total_incident_by_status->groupBy('status');

        $total_incident_by_status = $total_incident_by_status->map(function ($item, $key) {
            return [
                'total' => $item->sum('total'),
                'status' => $item->first()->status
            ];
        });

        $this->assertEquals($existing_incident_with_status_pendiente + 5, $total_incident_by_status['PENDIENTE']['total']);
        $this->assertEquals($existing_incident_with_status_atendido + 15, $total_incident_by_status['ATENDIDO']['total']);
    }
}
