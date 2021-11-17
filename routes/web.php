<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\StockDataController;

use App\Http\Controllers\TradeController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/', [Controller::class, 'home']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/user/profile', [UserController::class, 'showProfile'])->middleware('auth')->name('user.profile');
Route::post('/user/deposit',[UserController::class, 'deposit'])->middleware('auth')->name('user.deposit');
Route::get('user/trades',[UserController::class, 'showTrades'])->middleware('auth')->name('user.trades');

Route::post('/stock/{companySymbol}/buy',[TradeController::class, 'buy'])->middleware('auth')->name('stock.buy');
Route::post('/stock/sell',[TradeController::class,'sell'])->middleware('auth')->name('stock.sell');

Route::get('/stocks',[StockDataController::class,'index'])->middleware('auth')->name('stocks.index');
Route::get('/stocks/search',[StockDataController::class,'search'])->middleware('auth')->name('stocks.search');
Route::get('/stocks/{company}/info',[StockDataController::class,'info'])->middleware('auth')->name('stocks.info');


require __DIR__.'/auth.php';
