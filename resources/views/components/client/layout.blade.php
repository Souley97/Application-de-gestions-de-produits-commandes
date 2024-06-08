<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue Client</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md fixed w-full top-0 z-10">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="logo.png" alt="Logo" class="h-10">
            </div>
            <div class="w-2/2 mx-4">
                <a href="#"
                    class=" text-blue-500 hover:text-white  px-4 py-2 rounded hover:bg-blue-700">Mes commande</a>
                <a href="#"
                    class=" text-blue-500 hover:text-white  px-4 py-2 rounded hover:bg-blue-700">Produit</a>
            </div>



            <div class="flex items-center">
                <div class="mr-4">
                    <span class="text-gray-700 font-semibold">Admin Name</span>
                </div>
                <img src="admin-photo.jpg" alt="Admin Photo" class="h-10 w-10 rounded-full border-2 border-gray-300">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger  text-red-600 px-4 py-2 rounded hover:text-white hover:bg-red-700"
                        border-t-neutral-400 text-" type="submit">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-24 px-6">
        <div class="   duration-300">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
