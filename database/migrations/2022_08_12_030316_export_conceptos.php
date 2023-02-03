<?php

use App\Models\Multa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Helper\ProgressBar;

class ExportConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // new progress bar object
        $progress = new ProgressBar(
            $output = new \Symfony\Component\Console\Output\ConsoleOutput(),
            Multa::count()
        );

        Multa::chunk(1000, function ($multas) use ($progress) {
            /** @var Multa $multa */
            foreach ($multas as $multa) {
                $progress->advance();
                foreach ($multa->conceptos as $concepto) {
                    $multa->conceptos()->firstOrCreate($concepto);
                }
            }
        });
        $progress->finish();
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
