<x-client>
    <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Formulaire de commande -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-2xl font-bold mb-6">Passer une commande</h2>
            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block bg text-gray-700 font-bold mb-2">Nom:</label>
                    <input type="text" name="nom" id="nom" class="form-input  py-4 bg-gray-200 rounded-md border-gray-300 w-full"  placeholder="Ndiaye" required>
                </div>
                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 font-bold mb-2">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" class="form-input py-4 bg-gray-200  rounded-md border-gray-300 w-full"  placeholder="Souleymane" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email" class="form-input py-4 bg-gray-200  text-current rounded-md border-gray-300 w-full  focus:border"  placeholder="souleymane@gmail.com" required>
                </div>
               
                <button type="submit" class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 rounded">Passer la commande</button>
            </form>
        </div>

        <!-- Détails du produit -->
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <h2 class="text-2xl font-bold mb-6">Détails du produit</h2>
            <h3 class="text-2xl font-semibold mb-2">{{ $produit->designation }}</h3>
            <p class="text-gray-700 py-2"><strong>Référence:</strong> {{ $produit->reference }}</p>
            <p class="text-gray-700 py-2"><strong>Prix unitaire:</strong> {{ $produit->prix_unitaire }} Xof</p>
            <p class="text-gray-700 py-2"><strong>État:</strong> {{ ucfirst($produit->etat) }}</p>
            <p class="text-gray-700 py-2"><strong>Catégorie:</strong> {{ $produit->categorie->libelle }}</p>
            @if($produit->image)
                <div class="mt-4">
                    <strong>Image:</strong>
                    <img src="{{ asset('storage/produit/'.$produit->image) }}" alt="Image du produit" class="w-full h-48 object-cover rounded-md">
                </div>
            @endif
        </div>
    </div>
</x-client>
