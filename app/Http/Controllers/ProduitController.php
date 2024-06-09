<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Storage; // Ajoutez cette ligne


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
        $data['reference'] = 'ref-' . uniqid();



        Produit::create($data);

        return redirect()->route('admin.produits')->with('success', 'Produit ajouté avec succès');
    }

    public function show($id)
    {

        $produit = Produit::findOrFail($id);
        $autresProduits = Produit::all();
        return view('produits.show', compact('produit','autresProduits'));
    }


   // ProduitController.php

public function edit($id)
{
    $categories = Categorie::all(); // Si vous avez des catégories à afficher dans le formulaire

    $produit = Produit::findOrFail($id);

    return view('produits.edit', compact('produit', 'categories'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'designation' => 'required|string|max:55|min:4',
        'prix_unitaire' => 'required|numeric|min:3',
        'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'etat' => 'required|in:disponible,en_rupture,en_stock',
        'categorie_id' => 'required|exists:categories,id',
    ]);

    $produit = Produit::findOrFail($id);
    $data = $request->all();

    // Vérifier si un fichier image est uploadé
    if ($request->hasFile('image')) {
        // Supprimer l'ancienne image
        if ($produit->image) {
            Storage::delete('public/produit/' . $produit->image);
        }

        // Stocker la nouvelle image
        $chemin_image = $request->file('image')->store('public/produit');

        // Vérifier si le chemin de l'image est bien généré
        if (!$chemin_image) {
            return redirect()->back()->with('error', 'Erreur lors du téléchargement de l\'image.');
        }

        // Récupérer le nom du fichier de l'image
        $data['image'] = basename($chemin_image);
    }

    $produit->update($data);

    return redirect()->route('admin.produits')->with('success', 'Produit mis à jour avec succès');
}


    // methode pour la liste des products
    public function listeProduits() {
        $produits = Produit::all();
        return view( 'admin.produits', compact( 'produits' ) );
    }


    public function destroy($id)
{
    $produit = Produit::findOrFail($id);

    // Supprimer l'image associée au produit
    
   // Supprimer l'image associée au produit
   if ($produit->image) {
    Storage::delete('public/produit/' . $produit->image);
}

    // Supprimer le produit
    $produit->delete();

    return redirect()->route('admin.produits')->with('success', 'Produit supprimé avec succès');
}

    // Méthode pour afficher les commandes validee

}



