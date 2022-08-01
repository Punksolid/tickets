<?php

namespace App\Http\Controllers;


use App\Http\Requests\IncidentRequest;
use App\Jobs\MapService;
use App\Models\Incident;
use App\Services\RegisterNewIncidentInCuliacan;
use Goutte\Client;
use Illuminate\Http\Request;
use Monolog\Logger;
use Symfony\Component\HttpClient\HttpClient;


class IncidentsController extends Controller
{
    public function index(Request $request)
    {
        $incidents_query = Incident::query();

        if ($request->has('geocoded')) {
            $incidents_query->where('lat', '!=', null);
            $incidents_query->orWhere('lat', '!=', 0);
        }
        if ($request->has('reporte')) {
            $incidents_query->where('reporte', 'like', '%' . $request->get('reporte') . '%');
        }

        $incidents = $incidents_query->paginate();

        return view('incidents.index', ['incidents' => $incidents]);
    }

    public function show( $incident_folio)
    {

        $incident = Incident::where('folio', $incident_folio)->first();
        if (!$incident) {
            $incident = new Incident() ;
        }
        if (! auth()->check()) {
            $incident->ciudadano = null;
            // check if there is a phone number in $incient->reporte
            $incident->reporte = $this->replacePhoneNumberWithAsterisk($incident->reporte);
            $incident->reporte = $this->replaceNamesWithAsterisks($incident->reporte);
        }

        return view('incidents.show', ['incident' => $incident]);
    }

    private function replacePhoneNumberWithAsterisk($reporte)
    {
        return preg_replace('/\b\d{6,10}\b/', '**********', $reporte);
    }

    private function replaceNamesWithAsterisks($reporte)
    {
        $black_list_lastnames = [
            'García',
            'González',
            'López',
            'Martínez',
            'Méndez',
            'Rodríguez',
            'Sánchez',
            'Álvarez',
            'Gómez',
            'Pérez',
            'Reyes',
            'Ramírez',
            'Torres',
            'Flores',
            'Vázquez',
            'Ramos',
            'Gutiérrez',
            'Muñoz',
            'Álvaro',
            'Castillo',
            'Cortés',
            'Cabrera',
            'Santos',
            'Puente',
            'López',
            'García',
            'González',
            'López',
            'Martínez',
            'Méndez',
            'Rodríguez',
            'Sánchez',
            'Álvarez',
            'Gómez',
            'Pérez',
            'Reyes',
            'Ramírez',
            'Torres',
            'Flores',
            'Vázquez',
            'Ramos',
            'Gutiérrez',
            'Muñoz',
            'Álvaro',
            'Castillo',
            'Cortés',
            'Cabrera',
            'Santos',
            'Puente',
            'López',
            'García',
            'González',
            'López',
            'Martínez',
            'Méndez',
            'Rodríguez',
            'Sánchez',
            'Álvarez',
            'Gómez',
            'Pérez',
            'Reyes',
            'Ramírez',
            'Torres',
            'Flores',
            'Vázquez',
            'Ramos',
            'Gutiérrez',
            'Muñoz',
            'Álvaro',
        ];
        $top_first_names = [
            'Juan',
            'Carlos',
            'Pedro',
            'Miguel',
            'Luis',
            'Ricardo',
            'Jorge',
            'Antonio',
            'Manuel',
            'José',
            'Javier',
        ];

        foreach ($black_list_lastnames as $lastname) {
            $reporte = preg_replace('/\b' . $lastname . '\b/', '*****', $reporte);
        }
        foreach ($top_first_names as $firstname) {
            $reporte = preg_replace('/\b' . $firstname . '\b/', '*****', $reporte);
        }

        return $reporte;
    }

    public function create()
    {
        $services_types = MapService::getServiceTypesNames();

        return view('incidents.create', [
            'services_types' => $services_types,
        ]);
    }

    public function store(IncidentRequest $request)
    {
        $service_id = (new MapService())->getServiceIdBySubserviceId($request->get('service_type_id'));
        $register_new_incident_in_culiacan = new RegisterNewIncidentInCuliacan();
        try {
            $culiacan_government_incident_folio = $register_new_incident_in_culiacan->__invoke(
                $service_id,
                $request->service_type_id,
                $request->report_message,
                $request->neighborhood_id,
                $request->street_name,
                $request->postal_code
            );

        } catch (\Exception $exception) {
            \logger()->info($exception->getMessage(), [
                'service_id' => $service_id,
                'service_type_id' => $request->service_type_id,
                'report_message' => $request->report_message,
                'neighborhood_id' => $request->neighborhood_id,
                'street_name' => $request->street_name,
                'postal_code' => $request->postal_code,
            ]);

            return redirect()->back()->withErrors($exception->getMessage())->withInput();
        }

        return redirect(config('services.the_url') . '/consultar/' . $culiacan_government_incident_folio);
    }

}
