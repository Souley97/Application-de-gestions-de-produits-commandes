<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-gray-800 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-xl font-bold">MonSite</a>
            <div>
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-white mx-2">Inscription</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-white mx-2">Connexion</a>
            </div>
        </div>
    </nav>

    <div class="flex justify-center mt-10 fade-in flex-grow">
        <div class="w-full max-w-sm">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-800 p-4">
                    <h1 class="text-white text-center text-2xl font-semibold">Inscription</h1>
                </div>
                <div class="p-6">
                    <form id="inscriptionForm" action="{{route('register.save')}}" method="post">
                        @csrf
                        @if(Session::has('error'))
                        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                            {{ Session::get('error') }}
                        </div>
                        @endif

                        <input type="hidden"id="role" name="role"  required>


                        <div class="mb-4">
                            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
                            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="nom" placeholder="Nom" name="nom" value="{{ old('nom') }}" required>
                            @error('nom')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prenom</label>
                            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="prenom" placeholder="Prenom" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                            <input type="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                            <input type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" placeholder="Password" name="password" required>
                            @error('password')
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        


                        <div class="mb-4">
                            <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200">S'inscrire</button>
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
            $("#inscriptionForm").validate({
                rules: {
                    nom: {
                        required: true,
                        minlength: 2
                    },
                    prenom: {
                        required: true,
                        minlength: 2
                    },
                    telephone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
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
                    nom: {
                        required: "Veuillez entrer votre nom",
                        minlength: "Votre nom doit contenir au moins 2 caractères"
                    },
                    prenom: {
                        required: "Veuillez entrer votre prénom",
                        minlength: "Votre prénom doit contenir au moins 2 caractères"
                    },
                    telephone: {
                        required: "Veuillez entrer votre téléphone",
                        minlength: "Votre téléphone doit contenir 10 chiffres",
                        maxlength: "Votre téléphone doit contenir 10 chiffres"
                    },
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
