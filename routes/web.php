<?php

// Importation des contrôleurs nécessaires
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PanierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;

// Route pour la page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// Routes pour l'authentification
Route::controller(AuthController::class)->group(function () {
    // Affiche le formulaire d'inscription
    Route::get('/register', 'register')->name('register');
    // Enregistre un nouvel utilisateur
    Route::post('/register/save', 'registerSave')->name('register.save');

    // Affiche le formulaire de connexion
    Route::get('/login', 'login')->name('login');
    // Authentifie l'utilisateur
    Route::post('/login/save', 'loginSave')->name('login.save');

    // Déconnecte l'utilisateur
    Route::delete('/logout', 'logout')->name('logout');
});

// Routes pour la gestion des produits
Route::controller(ProduitController::class)->group(function () {
    // Affiche la liste des produits
    Route::get('/', 'index')->name('produit.index');

    // Affiche le formulaire de création de produit
    Route::get('/produit/create', 'create')->name('produits.create');
    // Enregistre un nouveau produit
    Route::post('/produit/save', 'store')->name('produits.store');

    // Affiche les détails d'un produit
    Route::get('/produit/detail/{id}', 'show')->name('produits.show');

    // Affiche le formulaire de modification d'un produit
    Route::get('/produits/{produit}/edit', 'edit')->name('produit.edit');
    // Met à jour un produit existant
    Route::put('/produits/{produit}/update', 'update')->name('produit.update');

    // Supprime un produit
    Route::delete('/produits/{produit}/delete', 'destroy')->name('produit.destroy');
});

// Routes pour la gestion des commandes
Route::controller(CommandeController::class)->group(function () {
    // Affiche le formulaire de création de commande pour un produit spécifique
    Route::get('/produits/{produit}/commandes/create', 'createCommande')->name('produits.commandes.create');
    // Affiche le formulaire de création de commande
    Route::get('/produits/commandes/create', 'create')->name('commande.create');

    // Enregistre une nouvelle commande pour un produit spécifique
    Route::post('produits/{produit}/commandes', 'storeCommande')->name('produits.commandes.store');
    // Ajoute un produit au panier
    Route::post('/panier/ajouter/{produitId}', 'ajouterAuPanier')->name('panier.ajouter');

    // Confirme une commande
    Route::post('/commandes/{commande}/confirmer', 'confirmerCommande')->name('client.commandes.confirmer');

    // Affiche les commandes de l'utilisateur
    Route::get('/mes-commandes', 'mesCommandes')->name('commandes.mes');
});

// Routes pour l'administration
Route::controller(AdminController::class)->prefix('admin')->middleware('auth')->group(function () {
    // Affiche le tableau de bord de l'admin
    Route::get('dashboard', 'index')->name('dashboard.admin');

    // Valide une commande
    Route::post('/commandes/{commande}/valider', 'validerCommande')->name('admin.commandes.valider');

    // Annule une commande
    Route::post('/commandes/{commande}/annuler', 'annulerCommande')->name('admin.commandes.annuler');

    // Affiche la liste des clients
    Route::get('/clients', 'listeClients')->name('admin.clients');

    // Affiche les commandes d'un client spécifique
    Route::get('/clients/{client}/commandes', 'commandesClient')->name('admin.clients.commandes');

    // Affiche les commandes en cours
    Route::get('/commandes/en-cours', 'commandesEnCours')->name('admin.commandes.encours');

    // Affiche les commandes validées
    Route::get('/commandes/validees', 'commandesValidees')->name('admin.commandes.validees');

    // Affiche les commandes annulées
    Route::get('/commandes/annulees', 'commandesAnnulees')->name('admin.commandes.annulees');

    // Affiche la liste des produits pour l'administration
    Route::get('/produits', 'listeProduits')->name('admin.produits');
});

// Routes pour la gestion des catégories
Route::controller(CategorieController::class)->prefix('admin')->group(function () {
    // Affiche la liste des catégories
    Route::get('categories', 'index')->name('admin.categories');

    // Enregistre une nouvelle catégorie
    Route::post('categories/store', 'store')->name('categories.store');

    // Supprime une catégorie
    Route::delete('categories/{categorie}', 'destroy')->name('categories.destroy');

    // Affiche le formulaire de modification d'une catégorie
    Route::get('categories/{id}/edit', 'edit')->name('categories.edit');
    // Met à jour une catégorie existante
    Route::put('categories/{categorie}', 'update')->name('categories.update');
});
