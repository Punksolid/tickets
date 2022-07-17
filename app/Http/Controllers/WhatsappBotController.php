<?php

namespace App\Http\Controllers;

use App\Jobs\MapService;
use App\Models\Incident;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tests\Feature\WhatsappBotControllerTest;
use Twilio\Http\Response;
use Twilio\Rest\Client;
use Twilio\Rest\Messaging;
use Twilio\TwiML\MessagingResponse;
use Twilio\TwiML\TwiML;
use Web3\Contract;


class WhatsappBotController extends Controller
{
    /**
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function newIncident()
    {

        $twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $twilio->getMessages()
            ->create("whatsapp:+5216672067464", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "Ytest"
                )
            );

    }

    public function botResponse(Request $request)
    {
        $citizens = cache()->get('citizens', []);

        $response = new MessagingResponse();
        $waId = $request->get('From');

        $citizen = $this->getCitizen($waId);
        if ($request->get('Body') == 'cancelar') {
            $response->message("Se ha cancelado el registro");
            cache()->forget('citizens');

            return $response;
        }

        if ($request->input('Body') != 'hola' && $citizen['step'] == 0) {
            $response->message("Hola, soy el bot de Whatsapp, no te preocupes, estoy aqui para ayudarte.");
            $response->message("Escribe 'hola' para comenzar.");
            cache()->put('citizens', $citizens, now()->addMinutes(5));

            return $response;
        }

        if ($request->input('Body') == 'hola'&& $citizen['step'] == 0 ) {
            $response->message("Hola, iniciemos el proceso de registro de un nuevo incidente.");
            $response->message($this->questions()[0]);
            $citizen['step'] = 1;
            $citizens[$waId] = $citizen;
            cache()->put("citizens", $citizens, now()->addMinutes(5));

            return $response;
        }

        $questions = $this->questions();

        if ($citizen['step'] <= count($questions)) {
            $question_index = $citizen['step'];
            $citizen[$questions[$question_index - 1]] = $request->get('Body');
            $citizen['step']++;
            $citizens[$waId] = $citizen;
            cache()->put('citizens', $citizens, now()->addMinutes(5));
            if ($citizen['step'] < 5){
                $response->message($questions[$question_index]);
//                $response->message($this->writeContext($citizen));

                return $response;
            }
        }

        $incident = Incident::create([
            'folio' => '',
            'dependencia' => $citizen['A cual dependencia va dirigido?'],
            'servicio' => '--',
            'id_asignacion' => '--',
            'reporte' => $citizen['Cual es el incidente?'],
            'ciudadano' => $citizen['Cual es su nombre?'] ?? 'Anonimo',
            'domicilio' => $citizen['Cual es la dirección del incidente?'],
            'fecha' => Carbon::now(),
            'usuario' => 'self',
            'asignacion' => '--',
            'status' => 'PENDIENTE',
        ]);
        if ($incident){
            $incident->folio = $incident->id;
            $incident->save();
            try {
                $this->registerInBlockchain($incident);
            } catch (\Exception $exception) {
                logger()->error('Blockchain Error: ', [$exception]);
            }
        }
        $response->message('Incidente registrado ' . $incident->id);
        $response->message('Gracias por utilizar el servicio de Whatsapp');
        $citizen['step'] = 0;
        $citizens[$waId] = $citizen;
        cache()->put("citizens", $citizens, now()->addMinutes(5));

        return $response;
    }


    /**
     * AKA steps
     * @return string[]
     */
    public function questions(): array
    {
        return [
            'Cual es su nombre?',
            'A cual dependencia va dirigido?',
//            'Cual es el tipo de servicio?',
            'Cual es el incidente?',
            'Cual es la dirección del incidente?',
        ];

    }

    /**
     * @param Request $request
     * @throws \Twilio\Exceptions\ConfigurationException
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function respond(string $mensaje, $account_sid = null): void
    {
// auth token config('services.twilio.token')
//        $sid = "config('services.twilio.sid')";
//        $token = "config('services.twilio.token')";
//        $twilio = new Client($sid, $token, $account_sid);
//
//        $twilio->messages
//            ->create("whatsapp:+5216672067464", [
//                    "from" => "whatsapp:+14155238886",
//                    "body" => $mensaje
//                ]
//            );
    }
    public function botStatus()
    {
        logger('botStatus');
    }
    private function getCitizen(string $waId)
    {
        $citizens = cache()->get('citizens', []);
        if (!isset($citizens[$waId])) {
            $citizens[$waId] = [
                'step' => 0
            ];
        }

        return $citizens[$waId];
    }

    private function registerInBlockchain($incident)
    {
        $abi = file_get_contents(base_path('ganache/artifacts/artifacts/ticketsContract.json'));
        $contract = new Contract('http://127.0.0.1:7545', $abi);

        $contract->at('0x7C67EF5A2B8Df0872b50a0a835d8841e04051F11');
        $from = '0x6C54873945e86C4994f411dbC84ecf46b5a0EFd9';
        logger('to save in blockchain', ['folio' => $incident->id]);
        $contract->send('addTicket', $incident->id, $incident->dependencia, $incident->reporte, $incident->domicilio, [
            'from' => $from,
            'gas' => '0x200b20'
        ], function ($err, $result) {
            if ($err !== null) {
//                dump('error');
                return ;
            }
            if ($result) {
//                echo "\nTransaction has made:) id: " . $result . "\n";
                logger('Transaction has made:) id: ' . $result);
            }
        });
    }

    private function getOptionsForDepartment(int $department_id): string
    {
        $map_service = new MapService();
        $get_services_options = $map_service->getServicesOptions($department_id);
        $formatted_options = [];
        foreach ($get_services_options as $service_option) {
            $formatted_options[] = "{$service_option['id_tipo_servicio']} - {$service_option['nombre_tipo_servicio']}";
        }

        return implode(', ', $formatted_options);
    }

    private function writeContext(string $citizen)
    {
        $citizen = $this->getCitizen($citizen);

        if ($citizen['step'] === 2){
            return $this->getOptionsForDepartment($citizen['department_id']);
        }
    }
}
