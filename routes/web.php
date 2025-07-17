<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontHomeController;

Route::get('/', [FrontHomeController::class, 'home'])->name('home');