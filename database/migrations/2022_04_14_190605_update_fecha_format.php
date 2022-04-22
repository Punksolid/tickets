<?php

use App\Models\Incident;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFechaFormat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incidents', function (Blueprint $table) {
            $table->dateTime('reported_at')->nullable();
        });
        $incidents = Incident::all();
        foreach ($incidents as $incident) {
            $incident->reported_at = $incident->fecha;
            $incident->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
