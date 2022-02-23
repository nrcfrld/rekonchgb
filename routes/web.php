<?php

use App\Http\Controllers\BankIdentifierNumberController;
use App\Http\Controllers\ChargebackController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ReasonCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::group(["middleware" => ['auth:sanctum', 'verified']], function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user', [UserController::class, "index_view"])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/principal', [PrincipalController::class, "index_view"])->name('principal');
    Route::view('/principal/new', "pages.principal.new")->name('principal.new');
    Route::view('/principal/edit/{principalId}', "pages.principal.edit")->name('principal.edit');

    Route::get('/reason-code', [ReasonCodeController::class, "index_view"])->name('reason-code');
    Route::view('/reason-code/new', "pages.reason-code.new")->name('reason-code.new');
    Route::view('/reason-code/edit/{reasonCodeId}', "pages.reason-code.edit")->name('reason-code.edit');
    Route::get('/reason-code/export', [ReasonCodeController::class, "export"])->name('reason-code.export');
    Route::post('/reason-code/import', [ReasonCodeController::class, "import"])->name('reason-code.import');

    Route::get('/bank-identifier-number', [BankIdentifierNumberController::class, "index_view"])->name('bank-identifier-number');
    Route::view('/bank-identifier-number/new', "pages.bank-identifier-number.new")->name('bank-identifier-number.new');
    Route::view('/bank-identifier-number/edit/{bank-identifier-numberId}', "pages.bank-identifier-number.edit")->name('bank-identifier-number.edit');

    Route::get('/level', [LevelController::class, "index_view"])->name('level');
    Route::view('/level/new', "pages.level.new")->name('level.new');
    Route::view('/level/edit/{levelId}', "pages.level.edit")->name('level.edit');

    Route::get('/chargeback', [ChargebackController::class, "index_view"])->name('chargeback');
    Route::get('/chargeback/export', [ChargebackController::class, "export"])->name('chargeback.export');
    Route::post('/chargeback/import', [ChargebackController::class, "import"])->name('chargeback.import');
    Route::view('/chargeback/new', "pages.chargeback.new")->name('chargeback.new');
    Route::view('/chargeback/edit/{chargebackId}', "pages.chargeback.edit")->name('chargeback.edit');
});

Route::get('/dont-access/migrate-fresh', function () {
    return Artisan::call('migrate:fresh', ['--seed' => true]);
});
