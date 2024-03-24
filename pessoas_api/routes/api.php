<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserCitiesController;
use App\Http\Controllers\UserStatesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserAdressController;

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

Route::prefix('user')->group(function () {

    /*
    | Routes for CRUD users
    |
    */
	Route::prefix('/user')->group(function(){
		Route::get('/all',[UserController::class,'showAll'])->name('user.all');
		Route::post('/store',[UserController::class,'store'])->name('user.store');
		Route::get('/show/{id}',[UserController::class,'show'])->name('user.show');
		Route::put('/update/{id}',[UserController::class,'update'])->name('user.update');
		Route::delete('/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
	});

    /*
    | Routes for CRUD cities
    |
    */
	Route::prefix('/cities')->group(function(){
		Route::get('/all',[UserCitiesController::class,'showAll'])->name('cities.all');
		Route::post('/store',[UserCitiesController::class,'store'])->name('cities.store');
		Route::get('/show/{id}',[UserCitiesController::class,'show'])->name('cities.show');
		Route::put('/update/{id}',[UserCitiesController::class,'update'])->name('cities.update');
		Route::delete('/destroy/{id}',[UserCitiesController::class,'destroy'])->name('cities.destroy');
	});

    /*
    | Routes for CRUD states
    |
    */
	Route::prefix('/states')->group(function(){
		Route::get('/all',[UserStatesController::class,'showAll'])->name('states.all');
		Route::post('/store',[UserStatesController::class,'store'])->name('states.store');
		Route::get('/show/{id}',[UserStatesController::class,'show'])->name('states.show');
		Route::put('/update/{id}',[UserStatesController::class,'update'])->name('states.update');
		Route::delete('/destroy/{id}',[UserStatesController::class,'destroy'])->name('states.destroy');
	});

    /*
    | Routes for CRUD adresses
    |
    */
	Route::prefix('/adress')->group(function(){
		Route::get('/all',[UserAdressController::class,'showAll'])->name('states.all');
		Route::post('/store',[UserAdressController::class,'store'])->name('states.store');
		Route::get('/show/{id}',[UserAdressController::class,'show'])->name('states.show');
		Route::put('/update/{id}',[UserAdressController::class,'update'])->name('states.update');
		Route::delete('/destroy/{id}',[UserAdressController::class,'destroy'])->name('states.destroy');
	});
});