<?php

use App\Http\Controllers\BbsController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BbsController::class, 'index']);

Route::post('/', [BbsController::class, 'insert']);

Route::delete('/', [BbsController::class, 'delete']);

Route::put('/', [BbsController::class, 'update']);
