<?php

namespace Tests\Feature;

use App\Services\GetTotalPages;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetTotalPagesTest extends TestCase
{
    /**
     * TODO: Add mock
     * @return void
     */
    public function test_get_total_pages()
    {
        $total_pages_getter = new GetTotalPages();

        $this->assertEquals(3478, $total_pages_getter->__invoke());
    }
}
