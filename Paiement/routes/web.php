<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('home');
});

Route::match(['get', 'post'],"/paiement", [HomeController::class, 'paiement']);
Route::match(['get', 'post'],"/check-paiement", [HomeController::class, 'verify_paiementStatus']);
