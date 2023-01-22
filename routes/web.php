<?php

use App\Http\Controllers\TransactionReportController;
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

Route::get('/', [TransactionReportController::class, 'index']);

Route::get('/transaction-report', [TransactionReportController::class, 'index'])->name('index');
Route::get('/transaction-report/{id}', [TransactionReportController::class, 'show'])->name('view-items');
Route::get('/rankings', [TransactionReportController::class, 'rank'])->name('view-ranks');
