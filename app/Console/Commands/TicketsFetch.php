<?php

namespace App\Console\Commands;

use App\Jobs\FetchIncidentsJob;
use Illuminate\Console\Command;

class TicketsFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:fetch {start_page}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $start_page = $this->argument('start_page');

        if (!$start_page) {
            $start_page = 1;
        }
        $this->info('Fetching tickets from page ' . $start_page);
        // print to console the current time
        // with progress bar
        $total_pages = $this->getTotalPages();
        $total_pages = $total_pages - $start_page + 1;
        $bar = $this->output->createProgressBar($total_pages);
        $bar->start();
        // loop through all pages
        for ($page = $start_page; $page <= $total_pages; $page++) {

            dispatch(new FetchIncidentsJob($page));
            $bar->advance();
        }

        $bar->finish();
        return 0;
    }

    private function getTotalPages()
    {
        return round(67780 / 20) + 1;
    }
}
