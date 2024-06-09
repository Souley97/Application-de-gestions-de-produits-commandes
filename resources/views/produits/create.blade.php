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
   

    <div class="container mx-auto p-8 mt-14">
        <button class="  text-blue-500 px-4 py-2 rounded hover:text-white hover:bg-blue-700"> <a href="{{ route('produit.index') }} ">Retour </a></button>

        <h2 class="text-2xl font-bold mb-6">Créer un produit</h2>
        @if(Session::has('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-5" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ Session::get('error') }}
        </div>
    @endif
        <form action="{{ route('produits.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="designation" class="block text-gray-700 font-medium">Désignation</label>
                <input type="text" name="designation" id="designation" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('designation') border-red-500 @enderror" value="{{ old('designation') }}">
                @error('designation')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="prix_unitaire" class="block text-gray-700 font-medium">Prix unitaire</label>
                <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('prix_unitaire') border-red-500 @enderror" value="{{ old('prix_unitaire') }}">
                @error('prix_unitaire')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
          
            <div class="form-group">
                <label for="etat" class="block text-gray-700 font-medium">État</label>
                <select name="etat" id="etat" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('etat') border-red-500 @enderror">
                    <option value="disponible" {{ old('etat') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="en_rupture" {{ old('etat') == 'en_rupture' ? 'selected' : '' }}>En rupture</option>
                    <option value="en_stock" {{ old('etat') == 'en_stock' ? 'selected' : '' }}>En stock</option>
                </select>
                @error('etat')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="categorie_id" class="block text-gray-700 font-medium">Catégorie</label>
                <select name="categorie_id" id="categorie_id" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('categorie_id') border-red-500 @enderror">
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>{{ $categorie->libelle }}</option>
                    @endforeach
                </select>
                @error('categorie_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="w-full p-2  border-gray-300 rounded" rows="4"
                    class="form-label">Image</label>
                <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded"
                    rows="4" id="image">
                    @error('image')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition duration-300">Créer</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>

</body>
</html>
