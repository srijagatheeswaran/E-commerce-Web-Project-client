<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class,"index"]);

Route::get("login", [UserController::class,"login"])->name("login");

Route::get("register", [UserController::class,"register"])->name("register");

Route::post("register", [UserController::class,"createUser"])->name("register.post");

