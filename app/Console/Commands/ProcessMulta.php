<?php

namespace App\Console\Commands;

use App\Jobs\FetchAndScrapMulta;
use Doctrine\DBAL\Query\QueryException;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\HttpClient\Exception\TimeoutException;

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
        if ($start && $end && $start > $end) {
            throw new Exception('Start must be less than end');
        }
        // create progress bar
        $range = range($start, $end);
        $bar = $this->output->createProgressBar(count($range));
        $bar->setFormat("%message%\nFPS:%fps%\n%current%/%max% [%bar%] %percent:3s%%");
        // Calculate folios per second
        $time = time();
        $folios_per_second = 0;
        $folios_per_second_count = 0;
        foreach ($range as $folio) {
            $folios_per_second_count++;
            // print  every 10 seconds
            if (time() - $time > 10) {
                // count folios per second
                $folios_per_second = $folios_per_second_count / (time() - $time);
                $time = time();
                $folios_per_second_count = 0;
            }
            $bar->setMessage( (int)$folios_per_second, 'fps');


            $bar->setMessage('Processing folio ' . $folio);
            $bar->advance();
            if ($debug) {
                $this->info('Processing folio ' . $folio);
            }
            try {
                FetchAndScrapMulta::dispatch($folio);
            } catch (\InvalidArgumentException $exception) {
                logger()->warning('Error processing folio ' . $folio . "a node is not existing", [$exception->getMessage(), $exception->getTrace()]);
            } catch (TimeoutException $exception) {
                logger()->warning('Error processing folio Timeout' . $folio , [$exception->getMessage()]);
            }
        }
        $bar->finish();
        $this->info('Process finished');

        return 0;
    }
}
