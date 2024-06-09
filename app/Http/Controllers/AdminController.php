<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function index() {
        $commandes = Commande::with( 'client', 'commandeProduit.produit' )->get();
        return view( 'admin.index', compact( 'commandes' ) );

    }

    public function validerCommande( Commande $commande ) {
        // Valider la commande
        $commande->etat_commande = 'valide';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route( 'dashboard.admin' )->with( 'success', 'Commande validée avec succès.' );
    }

    public function annulerCommande( Commande $commande ) {
        // Annuler la commande
        $commande->etat_commande = 'annule';
        $commande->save();

        // Rediriger vers le tableau de bord avec un message de succès
        return redirect()->route( 'dashboard.admin' )->with( 'success', 'Commande annulée avec succès.' );
    }

    public function listeClients() {
        $clients = User::all();
        // $clients = User::all()->where( 'role', 'client' );
        return view( 'admin.clients', compact( 'clients' ) );
        

    }

    public function commandesClient( User $client ) {
        $commandes = $client->commandes()->with('produits')->get();

    return view( 'admin.commandes_client', compact( 'client' ,'commandes') );
    

}
  // Méthode pour afficher les commandes en cours
  public function commandesEnCours()
  {
      // Récupérer toutes les commandes en cours
      $commandesEnCours = Commande::where('etat_commande', 'encours')->with('client', 'produits')->get();

      // Retourner la vue avec les commandes en cours
      return view('admin.commandes_encours', compact('commandesEnCours'));
  }


//    // Méthode pour afficher les commandes validee
public function commandesValidees()
{
    $commandesValidees = Commande::where('etat_commande', 'valide')->with('client', 'produits')->paginate(8);
    return view('admin.commandes', ['commandes' => $commandesValidees, 'title' => 'Commandes Validées']);
}

//    // Méthode pour afficher les commandes annules
public function commandesAnnulees()
{
    $commandesAnnulees = Commande::where('etat_commande', 'annule')->with('client', 'produits')->paginate(8);
    return view('admin.commandes', ['commandes' => $commandesAnnulees, 'title' => 'Commandes Annulées']);
}
  
}
