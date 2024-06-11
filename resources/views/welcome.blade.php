<x-client>
    <!-- source: https://github.com/mfg888/Responsive-Tailwind-CSS-Grid/blob/main/index.html -->

    <!-- hero seciton -->
    <div class="relative w-full h-[220px]" id="home">
        <div class="relative inset-0 opacity-100">
            <img src="https://i.pinimg.com/564x/a9/66/d3/a966d3d7f0e574a61410b3304c08305b.jpg" alt="Background Image"
                class="object-cover object-center w-full " />

        </div>
        <div class="absolute inset-9 flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-4 md:mb-0">
                <h1 class="text-grey-700 font-medium text-4xl md:text-5xl leading-tight mb-2">Les fruits et légumes
                </h1>
                <p class="font-regular text-xl mb-8 mt-4">par type de famille

                </p>
                <a href="#contactUs"
                    class="px-6 py-3 bg-[#c8a876] text-white font-medium rounded-full hover:bg-[#c09858]  transition duration-200">Contact
                    Us</a>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">

        <section class="text-gray-700 body-font">
            <duve class="container  px-5 py-24 mx-auto">
                <div class="text-center p-10">
                    <h1 class="font-bold text-4xl mb-4">Categories</h1>
                    <h1 class="text-3xl">Kane & Frere</h1>
                </div>
                <div class="flex flex-wrap -m-4 text-center">

                    @foreach ($categories as $categorie)
                        <a href="{{ route('categories.produits', $categorie->id) }}"
                            class="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-green-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" class="text-red-500 w-12 h-12 mb-3 inline-block"
                                    viewBox="0 0 24 24">
                                    <path d="M8 17l4 4 4-4m-4-5v9"></path>
                                    <path d="M20.88 18.09A5 5 0 0018 9h-1.26A8 8 0 103 16.29"></path>
                                </svg>
                                <h2 class="title-font font-medium text-3xl text-gray-900">
                                    {{ $categorie->produits->count() }}</h2>
                                <p class="leading-relaxed">{{ $categorie->libelle }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>

    </div>
    </section>



    <div class="text-center p-10">
        <h1 class="font-bold text-4xl mb-4">Nos Derniers Produits</h1>

    </div>
    <!-- ✅ Grid Section - Starts Here 👇 -->
    <section id="Projects"
        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-4 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-4 mt-10 mb-5">


        <!--   🛑 Product card 1 - Ends Here  -->
        @foreach ($produits as $produit)
            <!--   ✅ Product card 2 - Starts Here 👇 -->
            <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
                <a href="{{ url('produit/detail/' . $produit->id) }}">
                    <img src="{{ asset('storage/produit/' . $produit->image) }}" alt="Product"
                        class="h-80 w-72 object-cover rounded-t-xl" />
                </a>
                <div class="px-4 py-3 w-72">
                    <span class="text-gray-400 mr-3 uppercase text-xs">{{ $produit->categorie->libelle }}</span>
                    <a href="{{ url('produit/detail/' . $produit->id) }}""
                        class="text-lg font-bold text-black truncate block capitalize">{{ $produit->designation }}</a>
                    <div class="flex items-center">
                        <p class="text-lg font-semibold text-black cursor-auto my-3">{{ $produit->prix_unitaire }}</p>
                        <del>
                            <p class="text-sm text-gray-600 cursor-auto ml-2"></p>
                        </del>
                        <div class="ml-auto">
                            <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="currentColor" class="bi bi-bag-plus    hover:text-red-500 " viewBox="0 0 16 16">

                                        <path fill-rule="evenodd"
                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                                        <path
                                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                    </svg></button>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        @endforeach



    </section>

    <!-- 🛑 Grid Section - Ends Here -->


    <!-- credit -->
    <div class="text-center py-10 px-10">
        <h2 class="font-bold text-2xl md:text-4xl mb-4">De nouvelles recettes de saison, savoureuses et abordables
        </h2>
    </div>
    </div>


    <!-- Support Me 🙏🥰 -->
    <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
    <script>
        kofiWidgetOverlay.draw('mohamedghulam', {
            'type': 'floating-chat',
            'floating-chat.donateButton.text': 'Support me',
            'floating-chat.donateButton.background-color': '#323842',
            'floating-chat.donateButton.text-color': '#fff'
        });
    </script>

    {{-- <h1 class=" mt-10  ">Hello {{Auth::user()->nom}}</h1> --}}


</x-client>
