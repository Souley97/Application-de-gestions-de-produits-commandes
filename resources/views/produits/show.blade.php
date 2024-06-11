<x-client>
    <div class="bg-gray-20 dark:bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row -mx-4">
                <div class="md:flex-1 px-4">
                    <div class="h-[460px] rounded-lg bg-gray-300 dark:bg-gray-700 mb-4">
                        <img class=" h-100 p-1 " src="{{ asset('storage/produit/' . $produit->image) }}" alt="Product Image">
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                                @csrf
                               
                            <button type="submit" class="w-full bg-gray-900 dark:bg-gray-600 text-white py-2 px-4 rounded-full font-bold hover:bg-gray-800 dark:hover:bg-gray-700">Ajouter au panier
                            </button>
                        </form>

                        </div>
                        <a href="{{ route('commandes.mes') }}" class="w-1/2 px-2">
                            <button class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-2 px-4 rounded-full font-bold hover:bg-gray-300 dark:hover:bg-gray-600">Mes commandes</button>
                        </a>
                    </div>
                </div>
                <div class="md:flex-1 px-4">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $produit->designation }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                        {{ $produit->reference }}
                    </p>
                   
                    <div class="flex mb-4">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 dark:text-gray-300">Prix unitaire:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ $produit->prix_unitaire }} Xof</span>
                        </div>
                        
                    </div> <div class="flex mb-4">
                       
                        <div>
                            <span class="font-bold text-gray-700 dark:text-gray-300">Etat:</span>
                            <span class="text-gray-600 dark:text-gray-300">{{ ucfirst($produit->etat) }}</span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="font-bold text-gray-700 dark:text-gray-300">Categorie:</span>
                        <div class="flex items-center mt-2">
                            <button class="w-6 h-6  mr-2">{{ $produit->categorie->libelle }}</button>
                            
                        </div>
                    </div>
                   
                    <div>
                    <div>
                        <span class="font-bold text-gray-700 dark:text-gray-300"> Description:</span>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mt-2">
                            Les fruits et légumes sont de véritables trésors de bienfaits et de convivialité. Pendant des jours ou des mois, ils se gorgent au soleil de vitamines et d’arômes. Des éléments indispensables à votre plaisir gustatif et à votre équilibre qu’ils restituent dans votre assiette ! Vous trouverez, sur ce site, tout ce qu’il vous faut pour en profiter et partager votre gourmandise.
                        </p>
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