<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;

Route::get('/', function () {
    return view('home');
});
