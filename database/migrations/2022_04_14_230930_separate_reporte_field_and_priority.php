<?php

use App\Models\Incident;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\Input;

class SeparateReporteFieldAndPriority extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(! Schema::hasColumn('incidents','priority')) {
            Schema::table('incidents', function($table) {
                $table->string('priority');
            });
        }
        $incidents = Incident::all();

        foreach ($incidents as $incident) {
            $reporte = explode(' ', $incident->reporte);
            $incident->priority = $reporte[0];
            unset($reporte[0]);
            $incident->reporte = implode(' ', $reporte);
            dump($incident->id);
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
        // drop column priority if exists
        if (Schema::hasColumn('incidents', 'priority')) {
            Schema::table('incidents', function (Blueprint $table) {
                $table->dropColumn('priority');
            });
        }
    }
}
