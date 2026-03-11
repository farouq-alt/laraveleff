<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminairController;

Route::get('/', function () {
    return view('welcome');
});

// Resource route for seminaires
// This creates all the standard routes for the SeminairController
Route::resource('seminaires', SeminairController::class);
