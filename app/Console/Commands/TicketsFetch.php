<?php

namespace App\Console\Commands;

use App\Jobs\FetchIncidentsJob;
use App\Services\GetTotalPages;
use Illuminate\Console\Command;

class TicketsFetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // Add boolean to indicate if we should fetch all incidents or just new ones
    protected $signature = 'tickets:fetch {start_page} {--sync : It will only fetch the new incidents.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all incidents or just new ones';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $is_only_sync = $this->option('sync');
        $start_page = $this->argument('start_page');

        if (!$start_page) {
            $start_page = 1;
        }
        $this->info('Fetching tickets from page ' . $start_page);
        if ($is_only_sync) $this->info('Sync activated ');


        $total_pages = $this->getTotalPages();
        $total_pages = $total_pages - $start_page + 1;
        $bar = $this->output->createProgressBar($total_pages);
        $bar->start();

        for ($page = $start_page; $page <= $total_pages; $page++) {

            dispatch(new FetchIncidentsJob($page, $is_only_sync));
            $bar->advance();
        }

        $bar->finish();
        return 0;
    }

    private function getTotalPages(): int
    {
        return (new GetTotalPages())->__invoke();
    }
}
