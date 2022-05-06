<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\WhatsappBotController;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('map');
});
Route::get('/incidents', [IncidentsController::class, 'index'])->name('incidents.index');
Route::get('/incidents/{incident}', [IncidentsController::class, 'show'])->name('incidents.show');
// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map', [DashboardController::class, 'map'])->name('map');
Route::get('/bot', [WhatsappBotController::class, 'newIncident'])->name('bot');


Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
