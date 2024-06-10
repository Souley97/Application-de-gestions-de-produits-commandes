<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller {
    
    // Méthode pour afficher le tableau de bord de l'administrateur
    public function index() {
        $commandes = Commande::with('client', 'commandeProduit.produit')->get();
        return view('admin.index', compact('commandes'));
    }

    // Méthode pour valider une commande
    public function validerCommande(Commande $commande) {
        // Valider la commande
        $commande->etat_commande = 'valide';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard.admin')->with('success', 'Commande validée avec succès.');
    }

    // Méthode pour annuler une commande
    public function annulerCommande(Commande $commande) {
        // Annuler la commande
        $commande->etat_commande = 'annule';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard.admin')->with('success', 'Commande annulée avec succès.');
    }

    // Méthode pour afficher la liste des clients
    public function listeClients() {
        $clients = User::all();
        return view('admin.clients', compact('clients'));
    }

    // Méthode pour afficher les commandes d'un client
    public function commandesClient(User $client) {
        $commandes = $client->commandes()->with('produits')->get();
        return view('admin.commandes_client', compact('client', 'commandes'));
    }

    // Méthode pour afficher les commandes en cours
    public function commandesEnCours() {
        $commandesEnCours = Commande::where('etat_commande', 'encours')->with('client', 'produits')->get();
        return view('admin.commandes_encours', compact('commandesEnCours'));
    }

    // Méthode pour afficher les commandes validées
    public function commandesValidees() {
        $commandesValidees = Commande::where('etat_commande', 'valide')->with('client', 'produits')->paginate(8);
        return view('admin.commandes', ['commandes' => $commandesValidees, 'title' => 'Commandes Validées']);
    }

    // Méthode pour afficher les commandes annulées
    public function commandesAnnulees() {
        $commandesAnnulees = Commande::where('etat_commande', 'annule')->with('client', 'produits')->paginate(8);
        return view('admin.commandes', ['commandes' => $commandesAnnulees, 'title' => 'Commandes Annulées']);
    }

    // Méthode pour afficher la liste des produits
    public function listeProduits() {
        $produits = Produit::all();
        return view('produits.liste_produits', compact('produits'));
    }
}
