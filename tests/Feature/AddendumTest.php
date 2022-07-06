<?php

namespace Tests\Feature;

use App\Models\Incident;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddendumTest extends TestCase
{
    use WithFaker;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateAddendum()
    {
        $this->withoutExceptionHandling();
        $ticket = Incident::factory()->create( );
        $description = $this->faker->text;

        $call = $this->post(route('addendums.store', ['incident' => $ticket->id]), [
            'description' => $description
        ]);

        $call->assertRedirect(route('incidents.show', ['incident' => $ticket->id]));
        $this->assertDatabaseHas('addendums',['description' => $description]);

    }
}
