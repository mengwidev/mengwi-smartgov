<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/mobilemenu', App\Http\Controllers\Api\MobileMenuController::class);
