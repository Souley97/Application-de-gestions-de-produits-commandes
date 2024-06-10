<x-layout>
    <div class="container-lg w-2/3 mx-auto p-8 mt-4">

        <div class=" justify-content-between  flex justify-between">
           
            <div>
                <h2 class="text-2xl font-bold mb-6">Créer un produit</h2>
            </div>
            <div>
                <button class="text-white px-4 py-2 rounded hover:text-white bg-red-500 hover:bg-red-700 mb-4">
                    <a href="{{ route('admin.produits') }}">Retour</a>
                </button>
            </div>
        </div>
     
        
        @if(Session::has('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-5" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ Session::get('error') }}
            </div>
        @endif
        
        <form action="{{ route('produits.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 h-100 md:grid-cols-2 gap-6">
                <div class="form-group mb-4">
                    <label for="designation" class="block text-gray-700 font-medium">Désignation</label>
                    <input type="text" name="designation" id="designation" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('designation') border-red-500 @enderror" value="{{ old('designation') }}">
                    @error('designation')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group mb-4">
                    <label for="prix_unitaire" class="block text-gray-700 font-medium">Prix unitaire</label>
                    <input type="number" step="0.01" name="prix_unitaire" id="prix_unitaire" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('prix_unitaire') border-red-500 @enderror" value="{{ old('prix_unitaire') }}">
                    @error('prix_unitaire')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
              
                <div class="form-group mb-4">
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
                
                <div class="form-group mb-4">
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

                <div class="form-group mb-4 md:col-span-2">
                    <label for="image" class="block text-gray-700 font-medium">Image</label>
                    <input type="file" name="image" id="image" class="form-control w-full p-2 border border-gray-300 rounded mt-1 @error('image') border-red-500 @enderror">
                    @error('image')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="w-1/2 bg-green-500 text-white p-3 mt-3 rounded hover:bg-green-600 transition duration-300">Créer</button>
            </div>
        </form>
    </div>
</x-layout>
