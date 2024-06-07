<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
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
        .sidebar:hover {
            width: 250px;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <div class="sidebar bg-white shadow-lg  h-screen w-64 hover:w-72 fixed transition-all duration-300">
            <div class="p-6">
            </div>
            <nav class="mt-20">
                <a href="#" class="flex items-center p-4 text-gray-700 hover:bg-gray-200 hover:scale-105 transition-all rounded">
                    <span class="material-icons-sharp">dashboard</span>
                    <span class="ml-4">Dashboard</span>
                </a>
                <a href="#" class="flex items-center p-4 text-gray-700 hover:bg-gray-200 hover:scale-105 transition-all rounded">
                    <span class="material-icons-sharp">shopping_cart</span>
                    <span class="ml-4">Commandes</span>
                </a>
                <a href="#" class="flex items-center p-4 text-gray-700 hover:bg-gray-200 hover:scale-105 transition-all rounded">
                    <span class="material-icons-sharp">pending</span>
                    <span class="ml-4">Commandes en cours</span>
                </a>
                <a href="#" class="flex items-center p-4 text-gray-700 hover:bg-gray-200 hover:scale-105 transition-all rounded">
                    <span class="material-icons-sharp">group</span>
                    <span class="ml-4">Liste des clients</span>
                </a>
                <form action="{{ route('logout') }}" method="post" class="mt-6 bottom-14 absolute">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full flex items-center  p-4 text-red-600 hover:bg-red-100 hover:scale-105 transition-all rounded">
                        <span class="material-icons-sharp">logout</span>
                        <span class="ml-4">Déconnexion</span>
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main content -->
        <div class=" flex-1">
            <!-- Navbar -->
            <div class="bg-white shadow-md py-4 px-6 fixed top-0 w-full flex items-center justify-between z-10">
                <div class="flex items-center">
                    <span class="text-3xl font-bold text-gray-800">App Logo</span>
                </div>
                <div class="w-1/4    mx-auto">
                    <input type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Recherche...">
                </div>
                <div class="flex items-center">
                    <span class="text-gray-800 mr-4">{{ Auth::user()->prenom }}</span>
                    <img src="https://bdesign-julinho97.vercel.app/assets/img/BMB.png" alt="Admin Photo" class="w-10 h-10 rounded-full">
                </div>
            </div>

            <!-- Content -->
            <div class="pt-24 ml-64 px-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>
