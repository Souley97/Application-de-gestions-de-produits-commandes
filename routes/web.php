<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function(){

    Route::get('/register','register')->name('register');
    Route::post('/register/save','registerSave')->name('register.save');

    Route::get('/login','login')->name('login');
    Route::post('/login/save','loginSave')->name('login.save');

    Route::delete('/logout','logout')->name('logout');



});


Route::controller(ProduitController::class)->group(function(){

    Route::get('/', 'index')->name('produit.index');

    Route::get('/produit/create', 'create')->name('produits.create');
    Route::post('/produit/save', 'store')->name('produits.store');



});
