<?php

namespace App\Console\Commands;

use App\Jobs\FetchAndScrapMulta;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Console\Command;

class ProcessMulta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multa:process {--start=} {--end=} {--debug} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and index multas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting process...');
        $force = $this->option('force');
        $start = $this->option('start');
        $end = $this->option('end');
        $debug = $this->option('debug');
        // validate start and end
        if ($start && $end) {
            if ($start > $end) {
                throw new Exception('Start must be less than end');
            }
        }
        // create progress bar
        $bar = $this->output->createProgressBar(count(range($start, $end)));
        foreach (range($start, $end) as $folio) {
            $bar->advance();
            if ($debug) {
                $this->info('Processing folio ' . $folio);
            }
            try {
                FetchAndScrapMulta::dispatch($folio);
            } catch (\InvalidArgumentException $exception) {
                logger()->warning('Error processing folio ' . $folio . "a node is not existing", [$exception->getMessage(), $exception->getTrace()]);
            }
        }
        $bar->finish();
        $this->info('Process finished');

        return 0;
    }
}
