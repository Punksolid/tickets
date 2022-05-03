<?php

namespace App\Repositories;

use App\Models\Incident;

class IncidentRepository
{

    public function __construct()
    {
    }

    public function getAllByDate()
    {
        if (config('database.default')  === 'sqlite') {
            Incident::selectRaw("strftime(\"%m-%Y\", reported_at) as date, count(*) as total")
                ->groupBy('date')
                ->orderBy('reported_at', 'asc')
                ->orderBy('date', 'asc')
                ->get();
        }

        return Incident::selectRaw("DATE_FORMAT(reported_at,'%d/%m') as date, count(*) as total")
            ->groupBy('date')
            ->orderBy('reported_at', 'asc')
            ->orderBy('date', 'asc')
            ->get();
    }
}
