<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;
use Psy\Readline\Userland;

class CommandeController extends Controller
{
    public function createCommande(Produit $produit)
    {
        return view('commandes.create', compact('produit'));
    }


    public function storeCommande(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:55|min:4',
            'prenom' => 'required|string|max:55|min:2',
            'email' => 'required|email|max:255',
            // Autres validations pour les informations de la commande
        ]);

         // Création ou récupération du client en fonction de l'email
    $client = User::firstOrCreate(
        ['email' => $request->email], // Recherche par email
        [   // Données à insérer si le client n'existe pas
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'role' => 'client',
            'password' => null
        ]
    );


        $commande = Commande::create([
            'reference' => 'cmd-' . uniqid(),
            'montant_total' => $produit->prix_unitaire,
            'etat_commande' => 'encours',
            'client_id' => $client->id // L'ID de la client saie 
        ]);
    // Attache le produit à la commande en ajoutant une entrée dans la table pivot (commande_produit).
        $commande->produits()->attach($produit->id);
        return dd($commande);

        // Autres actions à effectuer après la création de la commande (par exemple, redirection vers une page de confirmation)
    }

}
