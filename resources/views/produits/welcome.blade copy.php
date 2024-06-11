<x-client>
    

        {{-- <h1 class=" mt-10  ">Hello {{Auth::user()->nom}}</h1> --}}

        <section class="container mx-auto py-12">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Nos Derniers Produits</h2>
            <div class="p-1 flex flex-wrap items-center justify-center">
                @foreach ($produits as $produit)
        
                <div class="flex-shrink-0 m-6 relative overflow-hidden bg-orange-500 rounded-lg max-w-xs shadow-lg group">
                    <svg class="absolute bottom-0 left-0 mb-8 scale-150 group-hover:scale-[1.65] transition-transform"
                        viewBox="0 0 375 283" fill="none" style="opacity: 0.1;">
                        <rect x="159.52" y="175" width="152" height="152" rx="8" transform="rotate(-45 159.52 175)" fill="white" />
                        <rect y="107.48" width="152" height="152" rx="8" transform="rotate(-45 0 107.48)" fill="white" />
                    </svg>
                    <div class="relative pt-10 px-10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <div class="block absolute w-48 h-48 bottom-0 left-0 -mb-24 ml-3"
                            style="background: radial-gradient(black, transparent 60%); transform: rotate3d(0, 0, 1, 20deg) scale3d(1, 0.6, 1); opacity: 0.2;">
                        </div>
                        <img class="relative w-40" src="{{ asset('storage/produit/'.$produit->image) }}" alt="">
                    </div>
                    <div class="relative text-black px-6 pb-6 mt-6">
                        <span class="block opacity-75 -mb-1">{{ $produit->designation }}</span>
                        <div class="flex justify-between">
                            <span class="block font-semibold text-xl"> {{ $produit->categorie->libelle }}</span>
                            <span class="block bg-green-100 rounded-full text-orange-500 text-xs font-bold px-3 py-2 leading-none flex items-center">{{ $produit->prix_unitaire }} Xof</span>
                        </div>
                    </div>
                    <button
                    class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50 mt-4 w-full flex items-center justify-center">
                    Add to order
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </button>
                </div>
                @endforeach
            </div>
        </section>
    
</x-client>