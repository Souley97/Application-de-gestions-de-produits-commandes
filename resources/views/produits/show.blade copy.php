<x-client>
    <div class="sidebar bg-white shadow-lg py-13 w-full transition-all duration-300">
        <div class="container mx-auto py-2 mt-24">
            <h2 class="text-3xl font-bold mt-10 mb-6 text-center">Détails du produit</h2>
            <div class="max-w-5xl mx-auto py-11 mt-20 flex flex-wrap justify-center items-start">
                <div class="w-full md:w-1/2 px-4">
                    @if ($produit->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/produit/' . $produit->image) }}" alt="Image du produit"
                                class="w-full h-auto object-cover rounded-lg">
                        </div>
                    @endif
                </div>
                <div class="w-full md:w-1/2 px-4">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
                        <h3 class="text-2xl font-semibold mb-2">{{ $produit->designation }}</h3>
                        <p class="text-gray-700"><strong>Référence:</strong> {{ $produit->reference }}</p>
                        <p class="text-gray-700"><strong>Prix unitaire:</strong> {{ $produit->prix_unitaire }} Xof</p>
                        <p class="text-gray-700"><strong>État:</strong> {{ ucfirst($produit->etat) }}</p>
                        <p class="text-gray-700"><strong>Catégorie:</strong> {{ $produit->categorie->libelle }}</p>

                        @if (auth()->user())
                            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded">
                                    Ajouter au panier
                                </button>
                            </form>
                        @else
                            <a href="{{ route('produits.commandes.create', $produit->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Passer
                                une commande</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar bg-white shadow-lg h-screen w-full transition-all duration-300">
        <div class="mt-24 py-11">
            <h2 class="text-3xl font-bold mb-6 text-center">Autres produits</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($autresProduits as $autreProduit)
                    <div class="max-w-sm mx-auto bg-white shadow-md rounded-lg overflow-hidden">
                        @if ($autreProduit->image)
                            <img src="{{ asset('storage/produit/' . $autreProduit->image) }}" alt="Image du produit"
                                class="w-full h-48 object-cover rounded-t-lg">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $autreProduit->designation }}</h3>
                            <p class="text-gray-700"><strong>Référence:</strong> {{ $autreProduit->reference }}</p>
                            <p class="text-gray-700"><strong>Prix unitaire:</strong> {{ $autreProduit->prix_unitaire }} Xof</p>
                            <a href="{{ url('produit/detail/' . $autreProduit->id) }}"
                                class="block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-4">Voir
                                détails</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-client>