<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TradesController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [Controller::class, 'index']);

Route::get('/news', [Controller::class, 'home'])->middleware(['auth'])->name('home');

Route::get('/user/profile', [UsersController::class, 'profile'])->middleware('auth')->name('user.profile');
Route::post('/user/deposit', [UsersController::class, 'deposit'])->middleware('auth')->name('user.deposit');


Route::post('/stock/{companySymbol}/buy', [TradesController::class, 'buy'])->middleware('auth')->name('stock.buy');
Route::get('/stock/{trade}/sell', [TradesController::class, 'sellIndex'])->middleware('auth')->name('stock.sell');
Route::post('/stock/{trade}/sell', [TradesController::class, 'sell'])->middleware('auth')->name('stock.sell');
Route::get('stock/trades', [TradesController::class, 'showTrades'])->middleware('auth')->name('user.trades');
Route::get('stock/trades/history', [TradesController::class, 'showTradeTransactions'])->middleware('auth')->name('user.history');


Route::get('/stocks', [CompaniesController::class, 'index'])->middleware('auth')->name('stocks.index');
Route::get('/stocks/search', [CompaniesController::class, 'searchCompanies'])->middleware('auth')->name('stocks.search');
Route::get('/stocks/{company}/info', [CompaniesController::class, 'companyInfo'])->middleware('auth')->name('stocks.info');


require __DIR__ . '/auth.php';
