<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //

    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }


      // Afficher le formulaire de création de catégorie
      public function create()
      {
          return view('categories.create');
      }

      // Enregistrer une nouvelle catégorie
      public function store(Request $request)
      {
          $request->validate([
              'libelle' => 'required|string|max:255',
          ]);

          Categorie::create($request->all());

          return redirect()->route('admin.categories')
                           ->with('success', 'Catégorie créée avec succès.');
      }

      public function destroy(Categorie $categorie)
      {
          $categorie->delete();

          return redirect()->route('admin.categories')
                           ->with('success', 'Catégorie supprimée avec succès.');
      }

      public function edit($id)
      {
        $categorie=Categorie::find($id);
          return view('categories.edit', compact('categorie'));
      }

      // Mettre à jour une catégorie spécifique
      public function update(Request $request, Categorie $categorie)
      {
          $request->validate([
              'libelle' => 'required|string|max:255',
          ]);

          $categorie->update($request->all());

          return redirect()->route('admin.categories')
                           ->with('success', 'Catégorie mise à jour avec succès.');
      }
}
