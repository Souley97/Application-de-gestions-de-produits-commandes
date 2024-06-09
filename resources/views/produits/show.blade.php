<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Boutique</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

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

    <header class="bg-white w-full border-x-2 shadow-2xl pb-16">
        <div class="w-full mx-auto bg-white shadow-lg border-x-2 h-20 fixed z-50 flex justify-between px-36 items-center">
            <a href="#" class="text-3xl font-bold text-gray-800">Gestion commande</a>
            <nav>
                <ul class="flex space-x-4">
                    @auth
                    <li>
                        <a href="#" class="text-blue-500 hover:text-white px-4 py-2 rounded hover:bg-blue-700">Categories</a>
                        <a href="#" class="text-blue-500 hover:text-white px-4 py-2 rounded hover:bg-blue-700">Produit</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-red-600 px-4 py-2 rounded hover:text-white hover:bg-red-700" type="submit">Déconnexion</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
   

    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mt-5 mb-6">Détails du produit</h2>
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
                    <img src="{{ asset('storage/produit/'.$produit->image) }}" alt="Image du produit" class="w-full h-48 object-cover">
                </div>
                @endif
            </div>
            <div class="bg-gray-100 px-6 py-4 flex justify-between">
                <a href="{{ route('produits.commandes.create', $produit->id) }}" class="btn btn-primary">Passer une commande</a>

            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

</body>
</html>
