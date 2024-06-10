<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-green-500 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-xl font-bold">Kane & Frere</a>
            <div>
                <a href="{{ route('register') }}" class="text-white hover:text-white mx-2">Inscription</a>
                <a href="{{ route('login') }}" class="text-white hover:text-white mx-2">Connexion</a>
            </div>
        </div>
    </nav>

    <div class="flex justify-center mt-20 fade-in flex-grow">
        <div class="w-full max-w-sm">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-green-400 p-4">
                    <h1 class="text-white text-center text-2xl font-semibold">Connexion</h1>
                </div>
                <div class="p-6">
                    <form id="connexionForm" action="{{ route('login.save') }}" method="post">
                        @csrf
                        @if (Session::has('error'))
                            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" placeholder="email" name="email" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Mot de passe</label>
                            <input type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" placeholder="password" name="password" required>
                        </div>
                        <div class="mb-4">
                            <button class="w-full bg-red-400 text-white py-3 rounded-lg hover:bg-red-500 transition duration-200">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#connexionForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Veuillez entrer votre email",
                        email: "Veuillez entrer un email valide"
                    },
                    password: {
                        required: "Veuillez entrer votre mot de passe",
                        minlength: "Le mot de passe doit contenir au moins 6 caractères"
                    }
                }
            });
        });
    </script>
</body>
</html>
