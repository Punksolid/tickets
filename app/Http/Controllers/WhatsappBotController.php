<?php

namespace App\Http\Controllers;

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
        // auth token config('services.twilio.token')
        $sid    = "config('services.twilio.sid')";
        $token  = "config('services.twilio.token')";

        $accountSid = "config('services.twilio.sid')"; // Your Account SID from www.twilio.com/console
        $twilio = new Client($sid, $token);


        $message = $twilio->messages
            ->create("whatsapp:+5216672067464", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => "Ytest"
                )
            );

    }

    public function botResponse(Request $request)
    {

        $citizens = $request->session()->get('citizens', []);
        $response = new MessagingResponse();
        $waId = $request->get('From');
        $citizen = $this->getCitizen($waId);
        if ($request->get('Body') == 'cancelar') {
            $response->message("Se ha cancelado el registro");
            $request->session()->forget('citizens');
//            logger($citizens);

            return $response;
        }

        if ($request->input('Body') != 'hola' && $citizen['step'] == 0) {
            $response->message("Hola, soy el bot de Whatsapp, no te preocupes, estoy aqui para ayudarte.");
            $response->message("Escribe 'hola' para comenzar.");
            $request->session()->put('citizens', $citizens);

            return $response;
        }

        if ($request->input('Body') == 'hola'&& $citizen['step'] == 0 ) {
            $response->message("Hola, iniciemos el proceso de registro de un nuevo incidente.");
            $response->message($this->questions()[0]);
            $citizen['step'] = 1;
            $citizens[$waId] = $citizen;
            session()->put("citizens", $citizens);

            return $response;
        }

        // save in session again
        $questions = $this->questions();

        if ($citizen['step'] <= count($questions)) {
            $question_index = $citizen['step'];
            $citizen[$questions[$question_index - 1]] = $request->get('Body');
            $citizen['step']++;
            $citizens[$waId] = $citizen;
            $request->session()->put('citizens', $citizens);
            if ($citizen['step'] < 5){
                $response->message($questions[$question_index]);
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
            $this->registerInBlockchain($incident);
        }
        $response->message('Incidente registrado ' . $incident->id);
        $response->message('Gracias por utilizar el servicio de Whatsapp');
        $citizen['step'] = 0;
        $citizens[$waId] = $citizen;
        session()->put("citizens", $citizens);

        return $response;
    }


    public function questions()
    {
        return [
            'Cual es su nombre?',
            'A cual dependencia va dirigido?',
            'Cual es el incidente?',
            'Cual es la dirección del incidente?',
        ];

    }

    /**
     * @param Request $request
     * @return void
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
    private function getCitizen($waId)
    {
        $citizens = session()->get('citizens', []);
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
}
