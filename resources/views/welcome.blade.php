<x-client>
        {{-- <h1 class=" mt-10  ">Hello {{Auth::user()->nom}}</h1> --}}


        <section class="container mx-auto py-12">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Nos Derniers Produits</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                @foreach ($produits as $produit)
                <div class="product-card bg-white shadow-lg  border rounded-lg ">
                    @if($produit->image)
                    <a href="{{ asset('storage/produit/'.$produit->image) }}">
                    <img src="{{ asset('storage/produit/'.$produit->image) }}" alt="Image du produit" class="w-full p-0   bg-no-repeat cover bg-cover object-cover">
                  
                  </a>  @else
                    <div class="w-full h-48 bg-gray-200 flex ">
                        <span class="text-gray-500">Pas d'image</span>
                    </div>
                    @endif
                    <div class="p-2">
                        <h3 class="text-lg font-medium text-gray-900">{{ $produit->designation }}</h3>
                        <div class="flex items-center justify-between my-4">
                            <span class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">
                                <i class="fa-solid fa-layer-group"></i> Catégorie: {{ $produit->categorie->libelle }}
                            </span>
                            <span class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                <i class="fa-solid fa-hand-holding-dollar"></i> {{ $produit->prix_unitaire }} XOF
                            </span>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                <i class="fa-solid fa-border-top-left"></i> {{ $produit->etat }}
                            </span>
                            <a href="{{ url('produit/detail/' . $produit->id) }}"
                                class="text-blue-500 hover:text-blue-700 font-medium">
                                Voir détail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    
</x-client>