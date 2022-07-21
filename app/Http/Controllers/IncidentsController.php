<?php

namespace App\Http\Controllers;


use App\Models\Incident;
use Goutte\Client;
use Illuminate\Http\Request;
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

    public function show(Incident $incident)
    {
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
}
