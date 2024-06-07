<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $commandes = Commande::with('client', 'produitCommandes.produit' )->get();
        return view('admin.index', compact('commandes'));    }
}
