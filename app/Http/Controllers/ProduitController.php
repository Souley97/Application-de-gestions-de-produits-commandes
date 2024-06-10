<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Storage; // Ajoutez cette ligne


class ProduitController extends Controller
{
    // Méthode pour afficher tous les produits
    public function index()
    {
        $produits = Produit::all(); // Récupérer tous les produits depuis la base de données
        return view('welcome', compact('produits')); // Retourner la vue avec la liste des produits
    }

    // Méthode pour afficher le formulaire de création de produit
    public function create()
    {
        $categories = Categorie::all(); // Récupérer toutes les catégories
        return view('produits.create', compact('categories')); // Retourner la vue du formulaire de création avec les catégories
    }

    // Méthode pour enregistrer un nouveau produit dans la base de données
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'designation' => 'required|string|max:55|min:4',
            'prix_unitaire' => 'required|numeric|min:3',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'etat' => 'required|in:disponible,en_rupture,en_stock',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $admin = auth()->id(); // Récupérer l'ID de l'utilisateur authentifié
        $image = null;

        // Vérifier si un fichier image est uploadé
        if ($request->hasFile('image')) {
            // Stocker l'image dans le répertoire 'public/produit'
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

        Produit::create($data); // Enregistrer le produit dans la base de données

        return redirect()->route('admin.produits')->with('success', 'Produit ajouté avec succès'); // Rediriger vers la liste des produits avec un message de succès
    }

    // Méthode pour afficher les détails d'un produit
    public function show($id)
    {
        $produit = Produit::findOrFail($id); // Récupérer le produit avec l'ID spécifié
        $autresProduits = Produit::all(); // Récupérer tous les autres produits
        return view('produits.show', compact('produit', 'autresProduits')); // Retourner la vue des détails du produit avec la liste des autres produits
    }

    // Méthode pour afficher le formulaire de modification d'un produit
    public function edit($id)
    {
        $categories = Categorie::all(); // Récupérer toutes les catégories
        $produit = Produit::findOrFail($id); // Récupérer le produit avec l'ID spécifié
        return view('produits.edit', compact('produit', 'categories')); // Retourner la vue du formulaire de modification avec les données du produit et les catégories
    }

    // Méthode pour mettre à jour les informations d'un produit dans la base de données
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire de modification
        $request->validate([
            'designation' => 'required|string|max:55|min:4',
            'prix_unitaire' => 'required|numeric|min:3',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'etat' => 'required|in:disponible,en_rupture,en_stock',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit = Produit::findOrFail($id); // Récupérer le produit avec l'ID spécifié
        $data = $request->all(); // Récupérer toutes les données du formulaire

        // Vérifier si un fichier image est uploadé
        if ($request->hasFile(' image')) {
            // Supprimer l'ancienne image associée au produit
            if ($produit->image) {
                Storage::delete('public/produit/' . $produit->image);
            }

            // Stocker la nouvelle image dans le répertoire 'public/produit'
            $chemin_image = $request->file('image')->store('public/produit');

            // Vérifier si le chemin de l'image est bien généré
            if (!$chemin_image) {
                return redirect()->back()->with('error', 'Erreur lors du téléchargement de l\'image.');
            }

            // Récupérer le nom du fichier de l'image
            $data['image'] = basename($chemin_image);
        }

        $produit->update($data); // Mettre à jour les informations du produit dans la base de données

        return redirect()->route('admin.produits')->with('success', 'Produit mis à jour avec succès'); // Rediriger vers la liste des produits avec un message de succès
    }

    // Méthode pour afficher la liste des produits dans le panneau d'administration
    public function listeProduits() {
        $produits = Produit::all(); // Récupérer tous les produits
        return view('admin.produits', compact('produits')); // Retourner la vue avec la liste des produits
    }

    // Méthode pour supprimer un produit de la base de données
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id); // Récupérer le produit avec l'ID spécifié

        // Supprimer l'image associée au produit
        if ($produit->image) {
            Storage::delete('public/produit/' . $produit->image);
        }

        $produit->delete(); // Supprimer le produit de la base de données

        return redirect()->route('admin.produits')->with('success', 'Produit supprimé avec succès'); // Rediriger vers la liste des produits avec un message de succès
    }

    // Méthode pour afficher les commandes validées
    // Méthode à implémenter en fonction de la logique de votre application

}

