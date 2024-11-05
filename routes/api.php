<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProvinceController;

Route::get('/provinces', [ProvinceController::class, 'getProvinces']);
