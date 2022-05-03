<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Repositories\IncidentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->incidentsRepository = new IncidentRepository();
    }

    // index
    public function index()
    {

        $incidents = $this->incidentsRepository->getAllByDate();

        /** @var Collection $quantity_of_incidents_by_dependency */
        $quantity_of_incidents_by_dependency = Incident::
            select('dependencia', DB::raw('count(*) as total'))
            ->groupBy('dependencia')
            ->get();

        $total_reports = Incident::count();
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
        $total_incidents = Incident::count();
        $total_incident_by_status = $this->getTotalIncidentsByStatus();
        $total_geocoded_incidents = Incident::where('lat', '!=', null)->orWhere('lat', '!=', 0)->count();
        $total_de_usuarios_que_han_registrado_incidentes = $this->getFuncionarioConMenosIncidentes()->count();

        $aproximado_de_incidentes_con_status_pendiente = Incident::where('status', '=', 'Pendiente')->orWhere('status', 'PENDIENTE')->count();

        return view('dashboard.index', compact(
            'incidents',
            'quantity_of_incidents_by_dependency',
            'total_reports',
            'open_incidents_by_dependency',
            'total_incident_by_status',
            'total_incidents',
            'total_geocoded_incidents',
            'total_de_usuarios_que_han_registrado_incidentes',
            'aproximado_de_incidentes_con_status_pendiente'
        ));
    }

    public function map()
    {
        $mapped_incidents = Incident::where('lat', '!=', null)
            ->where('lng', '!=', null)
            ->select('id', 'lat', 'lng', 'reporte', 'dependencia')
            ->getQuery()
            ->get();

        $markers = $mapped_incidents->map(function ($item, $key) {
            $colors = [
                // yellow almost white
                'Alumbrado Publico' => '#fdfd96',
                'Aseo, Limpia y Lotes Baldios' => '#FFA500',
                'Inspeccion y Vigilancia' => '#FFFF00',
                'Dirección de Sistemas de Drenajes Pluviales' => '#008000',
                'Parques y Jardines del Ayuntamiento' => '#0000FF',
                'Obras Publicas' => '#800080',
            ];
            return [
                (float)$item->lat,
                (float)$item->lng,
                $item->reporte . sprintf(<<<HTML
                <br><a href="%s" class="btn btn-sm">Ver</a>
HTML, route('incidents.show', $item->id)),
                $colors[$item->dependencia] ?? '#000000',
            ];
        });
        return view('dashboard.map', compact('markers'));
    }

    private function getTotalIncidentsByStatus()
    {
        $total_incident_by_status = Incident::
        groupBy('status')
            ->select(DB::raw('count(*) as total, status'))
            ->get();
        $total_incident_by_status = $total_incident_by_status->groupBy('status');

        return $total_incident_by_status->map(function ($item, $key) {
            return [
                'total' => $item->sum('total'),
                'status' => ucfirst(strtolower($item->first()->status))
            ];
        });
    }

    private function getFuncionarioConMenosIncidentes()
    {
        $funcionario_con_menos_incidentes = Incident::
        groupBy('usuario')
            ->select(DB::raw('count(*) as total, usuario'))
            ->get();

        $funcionario_con_menos_incidentes = $funcionario_con_menos_incidentes->groupBy('usuario');
        return $funcionario_con_menos_incidentes->map(function ($item) {
            return [
                'total' => $item->sum('total'),
                'usuario' => $item->first()->usuario
            ];
        });
    }


}
