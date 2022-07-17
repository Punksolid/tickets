<?php

namespace App\Console\Commands;

use App\Models\Incident;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RegisterIncidentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:new';


    protected $description = 'Create an incident manually from command, emulating chatbot';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ask for the user's name
        $name = $this->ask('What is your name? This is optional.');
        // Ask for dependency, give options
        $dependency = $this->choice('What is your dependency?', ['--', 'Alumbrado Publico', 'Inspeccion y Vigilancia', 'Parques y Jardines del Ayuntamiento']);
        // Ask for the reporte
        $report = $this->ask('What is the incident?');
        // Ask for address
        $address = $this->ask('What is the address of the incident?');

        $incident = Incident::create([
            'folio' => '',
            'dependencia' => $dependency,
            'servicio' => '--',
            'id_asignacion' => '--',
            'reporte' => $report,
            'ciudadano' => $name ?? 'Anonimo',
            'domicilio' => $address,
            'fecha' => Carbon::now(),
            'usuario' => 'self',
            'asignacion' => '--',
            'status' => 'PENDIENTE',
        ]);

        $this->info('Incident registered successfully!');
        $this->info('Incident ID: ' . $incident->id);
        return 0;
    }
}
