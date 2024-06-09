<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitController;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(AuthController::class)->group(function () {

    Route::get('/register', 'register')->name('register');
    Route::post('/register/save', 'registerSave')->name('register.save');

    Route::get('/login', 'login')->name('login');
    Route::post('/login/save', 'loginSave')->name('login.save');

    Route::delete('/logout', 'logout')->name('logout');
});


Route::controller(ProduitController::class)->group(function () {

    Route::get('/', 'index')->name('produit.index');

    Route::get('/produit/create', 'create')->name('produits.create');
    Route::post('/produit/save', 'store')->name('produits.store');

    Route::get('/produit/detail/{id}', 'show')->name('produits.show');
});


Route::controller(CommandeController::class)->group(function () {

    Route::get('/produits/{produit}/commandes/create', 'createCommande')->name('produits.commandes.create');
    Route::get('/produits/commandes/create', 'create')->name('commande.create');

    Route::post('produits/{produit}/commandes', 'storeCommande')->name('produits.commandes.store');
    Route::post('/panier/ajouter/{produitId}', 'ajouterAuPanier')->name('panier.ajouter');



    Route::get('/mes-commandes', 'mesCommandes')->name('commandes.mes');



    

});


// Admin routes
Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function () {

    Route::get('dashboard', 'index')->name('dashboard.admin');

    // Route pour valider une commande
    Route::post('/commandes/{commande}/valider', 'validerCommande')->name('admin.commandes.valider');

    // Route pour annuler une commande
    Route::post('/commandes/{commande}/annuler', 'annulerCommande')->name('admin.commandes.annuler');

    // Route pour voir liste clients a commande
    Route::get('/clients', 'listeClients')->name('admin.clients');

    //  Route pour Voir liste commandes a un client
    Route::get('/clients/{client}/commandes', 'commandesClient')->name('admin.clients.commandes');

    // Route pour voir liste des commandes en cours
    Route::get('/commandes/en-cours', 'commandesEnCours')->name('admin.commandes.encours');


    //  Route pour voir liste des commandes validees
    Route::get('/commandes/validees', 'commandesValidees')->name('admin.commandes.validees');

     //  Route pour voir liste des commandes validees
    Route::get('/commandes/annulees', 'commandesAnnulees')->name('admin.commandes.annulees');
});
