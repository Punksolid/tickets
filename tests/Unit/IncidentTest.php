<?php

namespace Tests\Unit;

use App\Models\Incident;
use PHPUnit\Framework\TestCase;

class IncidentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_query_open_incidents_by_dependency()
    {
        dd(Incident::first());
    }
}
