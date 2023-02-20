<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatsController;
use App\Http\Controllers\ReferentielsController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\DashboardController;
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
    return view('welcome');
});

Route::resource('types', TypesController::class);
Route::resource('referentiels', ReferentielsController::class);
Route::resource('formations', FormationsController::class);
Route::resource('candidats', CandidatsController::class);

Route::post('formations/{formation}/referentiels', [FormationsController::class, 'storeReferentiel'])->name('formations.storeReferentiel');
Route::post('candidats/{candidat}/formations', [CandidatsController::class, 'storeFormation'])->name('candidats.storeFormation');

Route::get('/candidatures-par-formation', [DashboardController::class, 'candidaturesParFormation'])->name('c-p-f');
Route::get('/formations-par-referentiel', [DashboardController::class, 'formationsParReferentiel'])->name('f-p-r');
Route::get('/candidatures-par-sexe', [DashboardController::class, 'candidaturesParSexe'])->name('c-p-s');
Route::get('/formations-par-type', [DashboardController::class, 'formationsParType'])->name('f-p-t');
Route::get('/tranches-age', [DashboardController::class, 'trancheAge'])->name('t-a');
Route::get('/formations-par-statut', [DashboardController::class, 'formationsParStatut'])->name('f-p-s');


