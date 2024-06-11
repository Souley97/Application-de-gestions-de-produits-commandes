<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hover-scale {
            transition: transform 0.3s;
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .sidebar {
            transition: width 0.3s;
        }

       

        .active {
            background-color: #c6f6d5;
            color: #10b981;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <!-- Logo -->
                <span class="text-2xl font-bold">Kane & Frere</span>
            </a>

            <!-- Centered Menu Items -->
            <div class="w-1/3 flex justify-center">
                <a href="{{ url('/') }}" class="text-green-500 hover:text-white px-4 py-2 rounded hover:bg-green-700 mx-2">Produit</a>
                @if (auth()->user())
                    <a href="{{ route('commandes.mes') }}" class="text-green-500 hover:text-white px-4 py-2 rounded hover:bg-green-700 mx-2">Mes commandes</a>
                @endif
            </div>

            @if (auth()->user())
            <div class="flex items-center space-x-4">
                <!-- Panier -->
                @if(session('commande_en_cours'))
                    <a href="{{ route('commandes.panier') }}" class="relative">
                        <i class="fas fa-shopping-cart text-3xl text-green-500"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs px-2">{{ session('nombre_produits_panier') }}</span>
                    </a>
                @endif
                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="dropbtn text-gray-700 font-semibold">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</button>
                    <div class="dropdown-content">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Déconnexion</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="text-green-500 hover:text-white px-4 py-2 rounded hover:bg-green-700 mx-2">Connection</a>
                <a href="{{ url('/') }}" class="text-green-500 hover:text-white px-4 py-2 rounded hover:bg-green-700 mx-2">Produit</a>
            </div>
            @endif
        </div>
    </nav>
    

    <!-- Main content -->
    <div class="pt-20 px-8">
        
            {{ $slot }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>

</html>
