<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('welcome', compact('produits'));
        
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation' => 'required|string|max:55|min:4',
            'type' => 'nullable|string|max:55|min:4',
            'prix_unitaire' => 'required|numeric|min:3',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'etat' => 'required|in:disponible,en_rupture,en_stock',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $admin= auth()->id();
        $image = null;

        // Vérifier si un fichier image est uploadé
        if ($request->hasFile('image')) {
            // Stocker l'image dans le répertoire 'public/blog'
            $chemin_image = $request->file('image')->store('public/produit');

            // Vérifier si le chemin de l'image est bien généré
            if (!$chemin_image) {
                return redirect()->back()->with('error', 'Erreur lors du téléchargement de l\'image.');
            }

            // Récupérer le nom du fichier de l'image
            $image = basename($chemin_image);
        }

        // Créer le produit avec les données validées et le chemin de l'image
        $data = $request->all();
        $data['image'] = $image;
        $data['user_id'] = $admin;

        Produit::create($data);

        return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès');
    }
}



