<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $commandes = Commande::with('client', 'produitCommandes.produit' )->get();
        return view('admin.index', compact('commandes'));   
     }

    public function validerCommande(Commande $commande)
    {
        // Valider la commande
        $commande->etat_commande = 'valide';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard.admin')->with('success', 'Commande validée avec succès.');
    }

    public function annulerCommande(Commande $commande)
    {
        // Annuler la commande
        $commande->etat_commande = 'annule';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route('dashboard.admin')->with('success', 'Commande annulée avec succès.');
    }
}
