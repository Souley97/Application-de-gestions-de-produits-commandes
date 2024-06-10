<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CommandeController extends Controller {
    // Méthode pour afficher le formulaire de création de commande pour un produit spécifique
    public function createCommande( Produit $produit ) {
        return view( 'commandes.create', compact( 'produit' ) );
    }

    // Méthode pour afficher le formulaire de création de commande avec tous les produits disponibles
    public function create() {
        $produits = Produit::all();
        return view( 'commandes.create', compact( 'produits' ) );
    }

    // Méthode pour ajouter un produit au panier ou créer une nouvelle commande
    public function ajouterAuPanier( Request $request, $produitId ) {
        $produit = Produit::findOrFail( $produitId );
        $user = auth()->user();

        // Si l'utilisateur est authentifié
        if ($user) {
            // Récupérer ou créer la commande en cours de l'utilisateur
            $commande = $user->commandes()->where('etat_commande', 'aupanier')->first();

            if (!$commande) {
                $commande = new Commande();
                $commande->reference = 'cmd-' . uniqid();
                $commande->montant_total = 0; // Initialiser montant_total à 0
                $commande->etat_commande = 'aupanier';
                $commande->client_id = $user->id;
                $commande->save();
            }

            // Ajouter le produit à la commande seulement si ce n'est pas déjà ajouté
            // if (!$commande->produits()->where('produit_id', $produitId)->exists()) {
                $commande->produits()->attach($produit->id);
                
                // Mettre à jour le montant total de la commande
                $commande->montant_total += $produit->prix_unitaire;
                $commande->save();
            // }
    
            return redirect()->route('commandes.mes')->with('success', 'Produit ajouté à la commande avec succès.');
        } else {
            // Valider les entrées de l'utilisateur
            $request->validate([
                'nom' => 'required|string|max:55|min:4',
                'prenom' => 'required|string|max:55|min:2',
                'email' => 'required|email|max:255',
            ]);
            
            // Créer un nouvel utilisateur ou récupérer s'il existe déjà
            $nouvelUtilisateur = User::firstOrCreate(
                [ 'email' => $request->email ],
                [
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'role' => 'client',
                    'password' => Hash::make( 'passer' ),
                ]
            );

            // Créer une commande pour le nouvel utilisateur
            $commande = Commande::create( [
                'reference' => 'cmd-' . uniqid(),
                'montant_total' => $produit->prix_unitaire,
                'etat_commande' => 'aupanier',
                'client_id' => $nouvelUtilisateur->id,
            ] );

            // Ajouter le produit à la commande
            $commande->produits()->attach( $produit->id );

            // Connecter automatiquement l'utilisateur
            Auth::login($nouvelUtilisateur);
            
            return redirect()->route('commandes.mes')->with('success', 'Produit ajouté à la commande avec succès.');
        }
    }

    // Méthode pour confirmer une commande
    public function confirmerCommande( Commande $commande ) {
        // Changer l'état de la commande à 'encours'
        $commande->etat_commande = 'encours';
        $commande->save();

        // Rediriger vers la page précédente avec un message de succès
        return redirect()->back()->with( 'success', 'Commande confirmée avec succès.' );
    }

    // Méthode pour afficher les commandes d'un utilisateur connecté
    public function mesCommandes() {
        $user = auth()->user();
        $commandes = $user->commandes()->orderBy('created_at', 'desc')->paginate(10);

        return view('commandes.mes_commande', compact('commandes'));
    }
}
