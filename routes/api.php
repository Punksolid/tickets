<?php

use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\WhatsappBotController;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/v1/incidents', [IncidentsController::class, 'index']);


Route::post('/botResponse', [WhatsappBotController::class, 'botResponse'])
    ->withoutMiddleware(AuthenticateSession::class)
    ->middleware(StartSession::class)
    ->name('bot-whatsapp.response-bot');
Route::post('/botStatus', [WhatsappBotController::class, 'botStatus'])->name('bot-whatsapp.status');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
