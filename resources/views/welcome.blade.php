<!DOCTYPE html>
<html lang="fr">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ma Boutique</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <style>
            .product-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
    
            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            }
        </style>
        <style>
            .carousel-item {
                background-size: cover;
                background-position: center;
                transition: opacity 1s ease-in-out;
            }

            .carousel-item.hidden {
                opacity: 0;
            }

            .carousel-item.active {
                opacity: 1;
            }
        </style>
    </head>

<body class="bg-slate-400">

    <header class="bg-white  w-full  border-x-2 shadow-2xl pb-16  ">
        <div class=" w-full mx-auto bg-white shadow-lg border-x-2 h-20  fixed bg-fixed z-50 flex justify-between px-36 items-center py-">
            <a href="#" class="text-3xl font-bold text-gray-800">Gestion commande</a>
            <nav>
                <ul class="flex  w-full space-x-4">
                    @auth
                    <li>
                        <a href="#" class=" text-blue-500 hover:text-white  px-4 py-2 rounded hover:bg-blue-700">Categories</a>
                        <a href="#" class=" text-blue-500 hover:text-white  px-4 py-2 rounded hover:bg-blue-700">Produit</a>
                    </li>
                    <li>

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger  text-red-600 px-4 py-2 rounded hover:text-white hover:bg-red-700" border-t-neutral-400 text-"
                                    type="submit">Déconnexion</button>
                            </form>

                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <div>

        {{-- <h1 class=" mt-10  ">Hello {{Auth::user()->nom}}</h1> --}}


        <section class="carousel mb-12 relative bg-slate-400">
           <header class="bg-gray-800 text-white py-4">
        <nav class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-xl font-bold">Ma Boutique</a>
            <ul class="flex space-x-4">
                <li><a href="#" class="hover:text-gray-400">Accueil</a></li>
                <li><a href="#" class="hover:text-gray-400">Produits</a></li>
                <li><a href="#" class="hover:text-gray-400">À propos</a></li>
                <li><a href="#" class="hover:text-gray-400">Contact</a></li>
            </ul>
        </nav>
    </header>
        </section>
    
        <section class="container mx-auto py-12">
            <h2 class="text-3xl font-bold text-center mb-16 text-gray-800">Nos Derniers Produits</h2>
    
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach ($produits as $produit)
                <div class="product-card bg-white shadow-md rounded-lg overflow-hidden">
                    @if($produit->image)
                    <img src="{{ $produit->image }}" alt="Image du produit" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Pas d'image</span>
                    </div>
                    @endif
                    <div class="p-6">
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
                            <a href="{{ url('produits/show/' . $produit->id) }}"
                                class="text-blue-500 hover:text-blue-700 font-medium">
                                Voir détail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
<html