<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_dashboard_is_shown()
    {
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);
    }
}
