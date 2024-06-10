
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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

        .active {
            background-color: #c6f6d5;
            /* Couleur de fond pour l'élément actif */
            color: #10b981;
            /* Couleur de texte pour l'élément actif */
        }
    </style>
    <script>
        function confirmAction(message, event) {
            if (!confirm(message)) {
                event.preventDefault();
            }
        }
    </script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <!-- ACTVE MENU -->
        <div class="sidebar bg-white shadow-lg h-screen w-64 hover:w-72 fixed transition-all duration-300">
            <div class="p-6">
            </div>
            <nav class="mt-20">
                <a href="{{ route('dashboard.admin') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('dashboard.admin')) active @endif">
                    <span class="material-icons-sharp">dashboard</span>
                    <span class="ml-4 text-green-700 font-bold">Dashboard</span>
                </a>
                <a href="{{ route('admin.commandes.validees') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('admin.commandes.validees')) active @endif">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="ml-4 text-green-700 font-bold">Commandes</span>
                </a>
                <a href="{{ route('admin.commandes.encours') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('admin.commandes.encours')) active @endif">
                    <span class="material-icons-sharp">pending</span>
                    <span class="ml-4 text-green-700 font-bold">Commandes en cours</span>
                </a>
                <a href="{{ route('admin.clients') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('admin.clients' , 'admin.clients.commandes')) active @endif">
                    <span class="material-icons-sharp ">group</span>
                    <span class="ml-4 text-green-700 font-bold">Liste des clients</span>
                </a>  
                <a href="{{ route('admin.produits') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('admin.produits')) active @endif">
                    <i class="fas fa-boxes"></i>
                    <span class="ml-4 text-green-700 font-bold">Liste des produits</span>
                </a> 
                <a href="{{ route('admin.categories') }}"
                    class="flex items-center p-4 text-gray-700 hover:bg-green-200 hover:scale-105 transition-all rounded @if (request()->routeIs('admin.categories')) active @endif">
                    <i class="fas fa-list"></i>
                    <span class="ml-4 text-green-700 font-bold">Liste des catégories</span>
                </a>

                
                <form action="{{ route('logout') }}" method="post" class="mt-6 bottom-14 absolute">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full flex items-center p-4 text-red-600 hover:bg-red-100 hover:scale-105 transition-all rounded">
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
                    <span class="text-3xl font-bold text-gray-800">Kane & Frere</span>
                </div>
                <div class="w-1/4    mx-auto">
                    <input type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="Recherche...">
                </div>
                <div class="flex items-center">
                    <span class="text-gray-800 mr-4">{{ Auth::user()->prenom }}</span>
                    <img src="https://bdesign-julinho97.vercel.app/assets/img/BMB.png" alt="Admin Photo"
                        class="w-10 h-10 rounded-full">
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
