<x-layout>
    <div class="container mx-auto w-2/3  p-8 mt-14">
        <div class=" justify-content-between  flex justify-between">
           
            <div>
                <h2 class="text-2xl font-bold mb-6">Modifier le produit</h2>
            </div>
            <div>
                <button class="text-white px-4 py-2 rounded hover:text-white bg-red-500 hover:bg-red-700 mb-4">
                    <a href="{{ route('admin.produits') }}">Retour</a>
                </button>
            </div>
        </div>
        @if (Session::has('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-5" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ Session::get('error') }}
            </div>
        @endif

        <form action="{{ route('produit.update', $produit->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="designation" class="block text-gray-700 font-bold mb-2">Désignation:</label>
                    <input type="text" name="designation" id="designation"
                        class="form-input py-2 px-4 border rounded-md w-full @error('designation') border-red-500 @enderror"
                        value="{{ old('designation', $produit->designation) }}" required>
                    @error('designation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="prix_unitaire" class="block text-gray-700 font-bold mb-2">Prix Unitaire:</label>
                    <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire"
                        class="form-input py-2 px-4 border rounded-md w-full @error('prix_unitaire') border-red-500 @enderror"
                        value="{{ old('prix_unitaire', $produit->prix_unitaire) }}" required>
                    @error('prix_unitaire')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="etat" class="block text-gray-700 font-bold mb-2">État:</label>
                    <select name="etat" id="etat"
                        class="form-select py-2 px-4 border rounded-md w-full @error('etat') border-red-500 @enderror"
                        required>
                        <option value="disponible" {{ old('etat', $produit->etat) == 'disponible' ? 'selected' : '' }}>
                            Disponible</option>
                        <option value="en_rupture" {{ old('etat', $produit->etat) == 'en_rupture' ? 'selected' : '' }}>
                            En rupture</option>
                        <option value="en_stock" {{ old('etat', $produit->etat) == 'en_stock' ? 'selected' : '' }}>En
                            stock</option>
                    </select>
                    @error('etat')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="categorie_id" class="block text-gray-700 font-bold mb-2">Catégorie:</label>
                    <select name="categorie_id" id="categorie_id"
                        class="form-select py-2 px-4 border rounded-md w-full @error('categorie_id') border-red-500 @enderror"
                        required>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}"
                                {{ old('categorie_id', $produit->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->libelle }}</option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 md:col-span-2">
                    <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                    <input type="file" name="image" id="image"
                        class="form-input py-2 px-4 border rounded-md w-full @error('image') border-red-500 @enderror">
                    @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    @if ($produit->image)
                        <img src="{{ Storage::url('produit/' . $produit->image) }}" alt="Image du produit"
                            class="mt-2 h-20 w-20 object-cover">
                    @endif
                </div>
            </div>

            <button type="submit"
                class="w-1/2 bg-green-500  p-3 mt-3 hover:bg-green-400 text-white font-bold     px-4 rounded mt-4">Mettre à jour</button>
        </form>
    </div>
</x-layout>
