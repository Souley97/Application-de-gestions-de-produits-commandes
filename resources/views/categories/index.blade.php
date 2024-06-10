<x-layout>
    <div class="container mt-5">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-3xl font-bold text-gray-800 mb-6">Catégories</h1>
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="libelle" class="block text-gray-700 font-medium">Libelle:</label>
                            <input type="text" name="libelle" id="libelle" class="form-input py-2 px-4 border rounded-md w-full" required>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition duration-300">
                                <span class="mr-2">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                Ajouter une nouvelle catégorie
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="w-full">
                    <thead class="text-green-600 px-0">
                        <tr>
                            <th class="py-3   uppercase font-semibold text-sm">Nom</th>
                            <th class="py-3  uppercase font-semibold text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-center">
                        @foreach ($categories as $categorie)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $categorie->libelle }}</td>
                                <td class="py-3 pl-7 flex space-x-2  text-center">
                                    <a href="{{ route('categories.edit', $categorie->id) }}" class=" ml-7  bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                                        <span class="mr-2">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        
                                    </a>
                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                            <span class="mr-2">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
