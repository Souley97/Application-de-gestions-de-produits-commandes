<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Psy\Readline\Userland;
use Illuminate\Support\Facades\Hash;


class CommandeController extends Controller
{
    public function createCommande(Produit $produit)
    {
        return view('commandes.create', compact('produit'));
    }

    public function create()
    {

        $produits = Produit::all(); // Récupérer tous les produits depuis le modèle Produit
        return view('commandes.create', compact('produits'));
         }


         public function ajouterAuPanier(Request $request, $produitId)
         {
             $produit = Produit::findOrFail($produitId);
             $user = auth()->user();
         
             // Si l'utilisateur est authentifié
             if ($user) {
                 // Récupérer ou créer la commande en cours de l'utilisateur
                 $commande = $user->commandes()->updateOrCreate(
                     ['etat_commande' => 'encours'],
                     ['reference' => 'cmd-' . uniqid()]
                 );
         
                 // Mettre à jour le montant total de la commande
                 $commande->update(['montant_total' => $commande->montant_total + $produit->prix_unitaire]);
         
                 // Ajouter le produit à la commande
                 $commande->produits()->attach($produit->id);
         
                 return redirect()->back()->with('success', 'Produit ajouté à la commande avec succès.');
             } else {
                 // Valider les entrées de l'utilisateur
                 $request->validate([
                     'nom' => 'required|string|max:55|min:4',
                     'prenom' => 'required|string|max:55|min:2',
                     'email' => 'required|email|max:255',
                 ]);
         
                 // Créer un nouvel utilisateur ou récupérer s'il existe déjà
                 $nouvelUtilisateur = User::firstOrCreate(
                     ['email' => $request->email],
                     [
                         'nom' => $request->nom,
                         'prenom' => $request->prenom,
                         'role' => 'client',
                         'password' => Hash::make('passer'),
                     ]
                 );
         
                 // Créer une commande pour le nouvel utilisateur
                 $commande = Commande::create([
                     'reference' => 'cmd-' . uniqid(),
                     'montant_total' => $produit->prix_unitaire,
                     'etat_commande' => 'encours',
                     'client_id' => $nouvelUtilisateur->id,
                 ]);
         
                 // Ajouter le produit à la commande
                 $commande->produits()->attach($produit->id);
         
                 // Connecter automatiquement l'utilisateur
                 Auth::login($nouvelUtilisateur);
         
                 return redirect()->back()->with('success', 'Produit ajouté à la commande avec succès.');
             }
         }

    
}
