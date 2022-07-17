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

    private function getCookie()
    {
        return "_ga=GA1.3.529770389.1648663605; ventanillaactiva=a%3A12%3A%7Bs%3A10%3A%22session_id%22%3Bs%3A32%3A%22e822d03a9b598608c6ddc3e37fc5fe7c%22%3Bs%3A10%3A%22ip_address%22%3Bs%3A15%3A%22189.203.204.158%22%3Bs%3A10%3A%22user_agent%22%3Bs%3A76%3A%22Mozilla%2F5.0+%28X11%3B+Ubuntu%3B+Linux+x86_64%3B+rv%3A98.0%29+Gecko%2F20100101+Firefox%2F98.0%22%3Bs%3A13%3A%22last_activity%22%3Bi%3A1649366300%3Bs%3A9%3A%22user_data%22%3Bs%3A0%3A%22%22%3Bs%3A10%3A%22id_usuario%22%3Bs%3A2%3A%2224%22%3Bs%3A7%3A%22usuario%22%3Bs%3A8%3A%22fernando%22%3Bs%3A6%3A%22id_rol%22%3Bs%3A1%3A%222%22%3Bs%3A14%3A%22id_dependencia%22%3BN%3Bs%3A6%3A%22nombre%22%3Bs%3A20%3A%22Eden+Fernando+Rivera%22%3Bs%3A9%3A%22prioridad%22%3Bs%3A6%3A%22NORMAL%22%3Bs%3A10%3A%22registrado%22%3Bb%3A1%3B%7D7f7b92f2221fe646017550f14982045d";
    }

    public function fetchPaginated()
    {

        // Create new Goutte client instance with params
        $goutte_client = new Client(HttpClient::create(['headers' => ['X-Requested-With' => 'XMLHttpRequest']]));

        $goutte_client->request('POST', 'https://apps.culiacan.gob.mx/070/atencion-ciudadana/reportes/paginacion/0', [
            'X-Requested-With' => 'XMLHttpRequest'
        ]);

//        $incidents = $crawler->filter('tbody > tr')->each(function ($node) {
//            $asignacion_field =$node->filter('td')->eq(3);
//            return [
//                'folio' => $node->filter('td')->eq(0)->text(),
//                'dependencia' => $node->filter('td')->eq(1)->text(),
//                'id_asignacion' => $node->filter('td')->eq(2)->text(),
//                'reporte' => $node->filter('td')->eq(4)->text(),
//                'ciudadano' => $node->filter('td')->eq(5)->text(),
//                'domicilio' => $node->filter('td')->eq(6)->text(),
//                'servicio' => $node->filter('td')->eq(7)->text(),
//                'fecha' => $node->filter('td')->eq(8)->text(),
//                'usuario' => $node->filter('td')->eq(9)->text(),
//                'asignacion' => $asignacion_field->filter('small')->text(),
//                'status' => $asignacion_field->filter('span')->text(),
//            ];
//        });
////        $incidents = $crawler->filter('tbody > tr')->each(function ($row) {
////            return $row->filter('td')->each(function ($field) {
////                return preg_replace( "/\r|\n|\t/", "", trim(strip_tags($field->html())) );;
////            });
////        });
//        dd($incidents);
//        dd($folio,
//            $dependencia,
//            $id_asignacion,
//            $asignacion,
//            $reporte,
//            $ciudadano,
//            $domicilio,
//            $servicio,
//            $fecha,
//            $usuario,
//            $estatus);
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
