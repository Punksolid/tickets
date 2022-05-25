<?php

namespace Tests\Feature;

use App\Models\Incident;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Web3\AbiDecoder;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3\Utils;
use Web3\Web3;

class WhatsappBotControllerTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    const ABI = <<<JSON
{"abi": [
		{
			"inputs": [
				{
					"internalType": "uint256",
					"name": "_folio",
					"type": "uint256"
				},
				{
					"internalType": "string",
					"name": "_department",
					"type": "string"
				},
				{
					"internalType": "string",
					"name": "_incident",
					"type": "string"
				}
			],
			"name": "addTicket",
			"outputs": [],
			"stateMutability": "nonpayable",
			"type": "function"
		},
		{
			"inputs": [
				{
					"internalType": "uint256",
					"name": "_folio",
					"type": "uint256"
				}
			],
			"name": "getTicket",
			"outputs": [
				{
					"components": [
						{
							"internalType": "uint256",
							"name": "folio",
							"type": "uint256"
						},
						{
							"internalType": "string",
							"name": "incident",
							"type": "string"
						},
						{
							"internalType": "string",
							"name": "department",
							"type": "string"
						}
					],
					"internalType": "struct ticketsContract.Ticket",
					"name": "",
					"type": "tuple"
				}
			],
			"stateMutability": "view",
			"type": "function"
		}
	]}
JSON;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_happy_path()
    {
        $this->withoutExceptionHandling();
        $whatsapp_incoming_message = [
            "SmsMessageSid" => "SMfbf33fc0451bced8006d42fa97283d0f",
            "NumMedia" => "0",
            "ProfileName" => "Ps",
            "SmsSid" => "SMfbf33fc0451bced8006d42fa97283d0f",
            "WaId" => "5216672067464",
            "SmsStatus" => "received",
            "To" => "whatsapp => +14155238886",
            "NumSegments" => "1",
            "ReferralNumMedia" => "0",
            "MessageSid" => "SMfbf33fc0451bced8006d42fa97283d0f",
            "AccountSid" => "config('services.twilio.sid')",
            "From" => "whatsapp:+5216672067464",
            "ApiVersion" => "2010-04-01"
        ];

        $body = [
            'hola',
            'Jose Manuel',
            'Alumbrado Publico',
            'Se fundio un foco',
            'Alvaro Obregon 2050, Col. Centro, Culiacan, Sinaloa.',
        ];

        foreach ($body as $value) {
            $whatsapp_incoming_message['Body'] = $value;
            $response = $this->post(route('bot-whatsapp.response-bot'), $whatsapp_incoming_message);
        }
        // Assert database has at least this values in a record
        $result = Incident::find(1);

        $this->assertEquals('Alumbrado Publico', $result->dependencia);
        $this->assertEquals('Se fundio un foco', $result->reporte);
        $this->assertEquals('Jose Manuel', $result->ciudadano);
        $this->assertEquals('Alvaro Obregon 2050, Col. Centro, Culiacan, Sinaloa.', $result->domicilio);

        session()->flush();
    }


    // new test to connect to web3.php
    public function test_connection_to_blockchain()
    {

        $abi = file_get_contents(base_path('ganache/artifacts/artifacts/ticketsContract.json'));
        $contract = new Contract('http://127.0.0.1:7545', $abi);

        $from = '0x6C54873945e86C4994f411dbC84ecf46b5a0EFd9';
        $contract->at('0xF27264b6D5a5c930aa4636Eb401D7B2785B24737');
        $folio = 1948;
        $department = 'jose';
        $incident = 'manuel';
        $contract->send('addTicket',  $folio, $department, $incident,  [
            'from' => $from,
            'gas' => '0x200b20'
        ], function ($err, $result) {
            if ($err !== null) {
                dump('error');
                return ;
            }
            if ($result) {
                echo "\nTransaction has made:) id: " . $result . "\n";
            }
        });

    }
}
