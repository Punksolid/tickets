<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddendumRequest;
use App\Http\Requests\UpdateAddendumRequest;
use App\Models\Addendum;
use App\Models\Incident;
use http\Client\Request;

class AddendumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Incident $incident, StoreAddendumRequest $request)
    {
        if (!$this->captchaValidation( $request)) {
            return redirect()->withErrors(['validation' => 'captcha falla']);
        };
        $addendum = $incident->addendums()->create(['description' => $request->get('description')]);
        if ($request->hasFile('evidence')) {
            $file = $request->file('evidence')->storePublicly('evidence/'. $incident->folio );
            $addendum->evidence_path = $file ;
            $addendum->save();
        }

        return redirect()->route('incidents.show', ['incident' => $incident]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Addendum $addendum)
    {
        //
    }

    protected function captchaValidation( $request)
    {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $remoteip = $_SERVER['REMOTE_ADDR'];

        $data = [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $request->get('recaptcha'),
            'remoteip' => $remoteip
        ];
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ],
            'ssl' => [
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ]
        ];
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $resultJson = json_decode($result, null, 512, JSON_THROW_ON_ERROR);
        if ($resultJson->success != true) {
            return back()->withErrors(['captcha' => 'ReCaptcha Error']);
        }
        if ($resultJson->score >= 0.3) {
            //Validation was successful, add your form submission logic here
            return true;
        } else {
            return back()->withErrors(['captcha' => 'ReCaptcha Error']);
        }
    }
}
