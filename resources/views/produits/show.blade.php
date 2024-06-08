<x-client>


<div class="container mx-auto mt-12">
    <h2 class="text-3xl font-bold mt-5 mb-6 text-center">Détails du produit</h2>
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h3 class="text-2xl font-semibold mb-2">{{ $produit->designation }}</h3>
            <p class="text-gray-700"><strong>Référence:</strong> {{ $produit->reference }}</p>
            <p class="text-gray-700"><strong>Type:</strong> {{ $produit->type }}</p>
            <p class="text-gray-700"><strong>Prix unitaire:</strong> {{ $produit->prix_unitaire }} €</p>
            <p class="text-gray-700"><strong>État:</strong> {{ ucfirst($produit->etat) }}</p>
            <p class="text-gray-700"><strong>Catégorie:</strong> {{ $produit->categorie->libelle }}</p>
            <p class="text-gray-700"><strong>Administrateur:</strong> {{ $produit->user->prenom }} {{ $produit->user->nom }}</p>
            @if($produit->image)
            <div class="mt-4">
                <strong>Image:</strong>
                <img src="{{ asset('storage/produit/'.$produit->image) }}" alt="Image du produit" class="w-full h-48 object-cover rounded-lg">
            </div>
            @endif
        </div>

        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST" class="px-6 pb-6">
            @csrf
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-300">
                Ajouter au panier
            </button>
        </form>
        
        <div class="bg-gray-100 px-6 py-4 flex justify-between">
            <a href="{{ route('produits.commandes.create', $produit->id) }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-300">
                Passer une commande
            </a>
        </div>
    </div>
</div>
</x-client>