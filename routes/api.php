<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domains\User\Http\Controllers\UserController;
use App\Domains\Transaction\Http\Controllers\TransactionController;
use App\Domains\Transaction\Observers\TransactionObserver;
use App\Domains\Transaction\Model\Transaction;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/users', [UserController::class, 'store']);
Route::post('/transactions', [TransactionController::class, 'store']);

