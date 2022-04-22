<?php

namespace App\Console\Commands;

use App\Models\Incident;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Spatie\Geocoder\Geocoder;

class GeocodeIncidentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tickets:geocode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Geocode pending incidents';

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
        $client = new Client();
        $geocoder = new Geocoder($client);
        // set token
        $geocoder->setApiKey(config('geocoder.key'));
        $geocoder->setLanguage('es');
        $geocoder->setRegion('mx');
        $geocoder->setCountry('mx');


        // get all incidents
        $incidents = Incident::whereNull('geocode')->get();
        $bar = $this->output->createProgressBar(count($incidents));
        foreach ($incidents as $incident) {
            if ($incident->geocode) {
                continue;
            }

            $geocode = $geocoder->getCoordinatesForAddress($incident->domicilio);
            $incident->lat = $geocode['lat'];
            $incident->lng = $geocode['lng'];
            $incident->geocode = $geocode;

            $incident->save();
            $bar->advance();
        }
        $bar->finish();
        return 0;
    }
}
