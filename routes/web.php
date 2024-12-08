<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class,"index"]);

Route::get('/dashboard', [UserController::class,"index"])->name("dashboard");

Route::get('logout',[UserController::class,'logout'])->name('logout');

Route::get("/login", [UserController::class,"login"])->name("login");
Route::post("/login", [UserController::class,"loginPost"])->name("login.post");


Route::get("/register", [UserController::class,"register"])->name("register");

Route::post("/register", [UserController::class,"createUser"])->name("register.post");

